<!DOCTYPE html>
<html lang=en>

    <?php
        include 'includes/head.inc.php';
        include_once 'includes/session.inc.php';
        include_once 'includes/memcache.inc.php';
        include_once 'includes/functions.inc.php'; 
    ?>

    <body>
        <?php include 'includes/header.inc.php'; ?>
        <br>
        <main>
            <section class="ui container">
                <h1 class="ui dividing header">Favorites</h1>
                <div class="ui segment">  
                    <div class="ui six doubling cards">
                        <?php
                        if (isset($_SESSION["favorites"])) {
                            foreach ($_SESSION["favorites"] as $item) {
                                $paintingID = $item[0];
                                $imageFileName = $item[1];
                                $title = $item[2];
                                echo '<div class="ui fluid card">';
                                echo '<div class="ui fluid image">';
                                $img = '<img src="images/art/works/square-small/' . $imageFileName . '.jpg">';
                                echo constructRelatedLink($paintingID, $img);
                                echo '</div>';
                                echo '<div class="extra">';
                                echo '<h4>';
                                echo constructRelatedLink($paintingID, $title);
                                echo '</h4>';
                                echo '<a href="remove-favorites.php?PaintID=' . $paintingID . '">';
                                echo    '<button class="ui right labeled icon button">';
                                echo    '<i class="close icon"></i>';
                                echo    'Remove';
                                echo    '</button>';
                                echo '</a>';
                                echo '</div>';
                                echo '</div>'; 
                            }
                        }
                        ?>
                    </div>
                </div>

                <div class="ui divider"></div>

                <div class="ui segment">
                    <a href="remove-favorites.php?PaintID=removeAll">
                        <button class="ui right labeled icon button">
                        <i class="close icon"></i>
                        Remove All Favorites
                        </button>
                    </a>     
                </div> 
            </section>
        </main>

        <footer class="ui black inverted segment">
            <div class="ui container">Trong Nguyen, 100848232</div>
        </footer>
    </body>
</html>