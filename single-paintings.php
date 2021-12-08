<!DOCTYPE html>
<html lang=en>

    <?php 
        include 'includes/head.inc.php';
        include_once 'includes/session.inc.php';
        include_once 'includes/functions.inc.php'; 
        $paintingID = isset($_GET["id"]) ? $_GET["id"] : 441;
        $painting = getPainting($paintingID);
        $artist = getArtist($painting->artistID);
        $gallery = getGallery($painting->galleryID);
    ?>

    <body>
        <?php include 'includes/header.inc.php'; ?>

        <main >
            <!-- Main section about painting -->
            <section class="ui segment grey100">
                <div class="ui doubling stackable grid container">
                
                    <div class="nine wide column">
                        <?php echo '<img src="images/art/works/medium/' . $painting->imageFileName . '.jpg" alt="..." class="ui big image" id="artwork">'; ?>   
                        <div class="ui fullscreen modal">
                            <div class="image content">
                                <?php echo '<img src="images/art/works/medium/' . $painting->imageFileName . '.jpg" alt="..." class="image" >'; ?>
                                <div class="description">
                                    <?php echo '<p>' . $painting->excerpt . '</p>'; ?>
                                </div>
                            </div>
                        </div>           
                    </div>	<!-- END LEFT Picture Column --> 
                    
                    <div class="seven wide column">
                        
                        <!-- Main Info -->
                        <div class="item">
                            <?php
                                echo '<h2 class="header">' . $painting->title . '</h2>';
                                echo '<h3>' . $painting->artistLastName . '</h3>';
                            ?>
                            <div class="meta">
                                <p>
                                <?php echo paintingRating($paintingID); ?>
                                </p>
                                <?php echo '<p>' . $painting->excerpt . '</p>'; ?>
                            </div>
                        </div>                          
                        
                        <!-- Tabs For Details, Museum, Genre, Subjects -->
                        <div class="ui top attached tabular menu ">
                            <a class="active item" data-tab="details"><i class="image icon"></i>Details</a>
                            <a class="item" data-tab="museum"><i class="university icon"></i>Museum</a>
                            <a class="item" data-tab="genres"><i class="theme icon"></i>Genres</a>
                            <a class="item" data-tab="subjects"><i class="cube icon"></i>Subjects</a>    
                        </div>
                        
                        <div class="ui bottom attached active tab segment" data-tab="details">
                            <table class="ui definition very basic collapsing celled table">
                            <tbody>
                                <tr>
                                <td>
                                    Artist
                                </td>
                                <td>
                                    <?php echo '<a href="' . $artist->artistLink . '">' . $artist->artistLastName . '</a>'; ?>
                                </td>                       
                                </tr>
                                <tr>                       
                                <td>
                                    Year
                                </td>
                                <td>
                                    <?php  echo $painting->yearOfWork; ?>
                                </td>
                                </tr>       
                                <tr>
                                <td>
                                    Medium
                                </td>
                                <td>
                                    <?php echo $painting->medium; ?>
                                </td>
                                </tr>  
                                <tr>
                                <td>
                                    Dimensions
                                </td>
                                <td>
                                    <?php echo $painting->width . 'cm x ' . $painting->height . 'cm'; ?>
                                </td>
                                </tr>        
                            </tbody>
                            </table>
                        </div>
                        
                        <div class="ui bottom attached tab segment" data-tab="museum">
                            <table class="ui definition very basic collapsing celled table">
                            <tbody>
                                <tr>
                                <td>
                                    Museum
                                </td>
                                <td>
                                    <?php echo $gallery->galleryName; ?>
                                </td>
                                </tr>       
                                <tr>
                                <td>
                                    Assession #
                                </td>
                                <td>
                                    <?php echo $painting->accessionNumber; ?>
                                </td>
                                </tr>  
                                <tr>
                                <td>
                                    Copyright
                                </td>
                                <td>
                                    <?php echo $painting->copyright; ?>
                                </td>
                                </tr>       
                                <tr>
                                <td>
                                    URL
                                </td>
                                <td>
                                    <?php echo '<a href="' . $painting->museumLink . '">View painting at museum site</a>'; ?>
                                </td>
                                </tr>        
                            </tbody>
                            </table>    
                        </div>     
                        <div class="ui bottom attached tab segment" data-tab="genres">
                            <ul class="ui list">
                                <?php echo getPaintingGenre($paintingID); ?>
                            </ul>
                        </div>  
                        <div class="ui bottom attached tab segment" data-tab="subjects">
                            <ul class="ui list">
                                <?php echo getPaintingSubject($paintingID); ?>
                            </ul>
                        </div>  
                        
                        <!-- Cart and Price -->
                        <div class="ui segment">
                            <div class="ui form">
                                <div class="ui tiny statistic">
                                <div class="value">
                                    <?php echo '$' . number_format($painting->msrp, 0 , "", ","); ?>
                                </div>
                                </div>
                                <div class="four fields">
                                    <div class="three wide field">
                                        <label>Quantity</label>
                                        <input type="number" min="0">
                                    </div>                               
                                    <div class="four wide field">
                                        <label>Frame</label>
                                        <select id="frame" class="ui search dropdown">
                                            <?php
                                                foreach (queryTypesFrame() as $typesFrame) {
                                                    echo '<option>' . $typesFrame->title . ' [$' . number_format($typesFrame->price, 0 , "", ",") . ']</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>  
                                    <div class="four wide field">
                                        <label>Glass</label>
                                        <select id="glass" class="ui search dropdown">
                                            <?php
                                                foreach (queryTypesGlass() as $typesGlass) {
                                                    echo '<option>' . $typesGlass->title . ' [$' . number_format($typesGlass->price, 0 , "", ",") . ']</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>  
                                    <div class="four wide field">
                                        <label>Matt</label>
                                        <select id="matt" class="ui search dropdown">
                                            <?php
                                                foreach (queryTypesMatt() as $typesMatt) {
                                                    echo '<option>' . $typesMatt->title . '</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>           
                                </div>                     
                            </div>

                            <div class="ui divider"></div>

                            <button class="ui labeled icon orange button">
                            <i class="add to cart icon"></i>
                            Add to Cart
                            </button>
                            <?php
                                echo '<a href="addToFavorites.php?PaintingID=' . $painting->paintingID . '&ImageFileName=' . $painting->imageFileName . '&Title=' . $painting->title . '">';
                                echo    '<button class="ui right labeled icon button">';
                                echo    '<i class="heart icon"></i>';
                                echo    'Add to Favorites';
                                echo    '</button>';
                                echo '</a>';
                            ?>       
                        </div>     <!-- END Cart -->                      
                                
                    </div>	<!-- END RIGHT data Column --> 
                </div>		<!-- END Grid --> 
            </section>		<!-- END Main Section --> 
            
            <!-- Tabs for Description, On the Web, Reviews -->
            <section class="ui doubling stackable grid container">
                <div class="sixteen wide column">
                
                    <div class="ui top attached tabular menu ">
                    <a class="active item" data-tab="first">Description</a>
                    <a class="item" data-tab="second">On the Web</a>
                    <a class="item" data-tab="third">Reviews</a>
                    </div>
                    
                    <div class="ui bottom attached active tab segment" data-tab="first">
                        <?php echo $painting->description; ?>
                    </div>	<!-- END DescriptionTab --> 
                    
                    <div class="ui bottom attached tab segment" data-tab="second">
                        <table class="ui definition very basic collapsing celled table">
                        <tbody>
                            <tr>
                            <td>
                                Wikipedia Link
                            </td>
                            <td>
                                <?php echo '<a href="' . $painting->wikiLink . '">View painting on Wikipedia</a>'; ?>
                            </td>                       
                            </tr>                       
                            
                            <tr>
                            <td>
                                Google Link
                            </td>
                            <td>
                                <?php echo '<a href="' . $painting->googleLink . '">View painting on Google Art Project</a>'; ?>
                            </td>                       
                            </tr>
                            
                            <tr>
                            <td>
                                Google Text
                            </td>
                            <td>
                                <?php echo '<p>' . $painting->googleDescription . '</p>'; ?>
                            </td>                       
                            </tr>                      
                        </tbody>
                        </table>
                    </div>   <!-- END On the Web Tab --> 
                    
                    <div class="ui bottom attached tab segment" data-tab="third">                
                        <div class="ui feed">
                            <?php outputReview($paintingID); ?>        
                        </div>                                
                    </div>   <!-- END Reviews Tab -->          
                
                </div>        
            </section> <!-- END Description, On the Web, Reviews Tabs --> 
            
            <!-- Related Images ... will implement this in assignment 2 -->    
            <section class="ui container">
            <h3 class="ui dividing header">Related Works</h3>
            
            <div class="ui segment">  
                <div class="ui six doubling cards">
                    <?php outputRelatedWork($artist->artistID); ?>  
                </div>
            </div>  
            
            </section>  
        </main>    

        <footer class="ui black inverted segment">
            <div class="ui container">Trong Nguyen, 100848232</div>
        </footer>
    </body>
</html>