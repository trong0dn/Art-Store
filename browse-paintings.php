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

        <main class="ui segment doubling stackable grid container">

            <section class="five wide column">
                <form class="ui form" action="" method="post">
                <h4 class="ui dividing header">Filters</h4>

                <div class="field">
                    <label>Artist</label>
                    <select class="ui fluid dropdown" name="Artist">
                        <?php outputArtist(); ?>
                    </select>
                </div>  
                <div class="field">
                    <label>Museum</label>
                    <select class="ui fluid dropdown" name="Museum">
                        <?php outputMuseum(); ?>
                    </select>
                </div>   
                <div class="field">
                    <label>Shape</label>
                    <select class="ui fluid dropdown" name="Shape">
                        <?php outputShape(); ?>
                    </select>
                </div>   

                    <button class="small ui orange button" type="submit" name="submit">
                    <i class="filter icon"></i> Filter 
                    </button>    

                </form>
            </section>

            <section class="eleven wide column">
                <h1 class="ui header">Paintings</h1>
                <p><strong>ALL PAINTINGS [TOP 20]</strong></p>
                    <?php 
                        try {
                            outputPainting(cacheFilters());
                        } catch (Exception $e) {
                            echo $e->getMessage();
                        } finally {
                            //outputPainting(querySelectFilter());
                        }
                    ?>     
            </section>  
        </main>    

        <footer class="ui black inverted segment">
            <div class="ui container">Trong Nguyen, 100848232</div>
        </footer>
    </body>
</html>