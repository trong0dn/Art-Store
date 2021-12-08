<?php

include_once 'includes/database.inc.php';
include_once 'includes/class.inc.php';

/**
 * Query for Paintings
 */
function queryPaintings() {
    $pdo = openConnection();
    $sql = "SELECT * FROM `paintings`, `artists` WHERE `paintings`.`ArtistID`=`artists`.`ArtistID`";
    $result = $pdo->query($sql);
    while ($record = $result->fetch()) {
        $paintings[] = new Painting($record);
    }
    closeConnection();
    return $paintings;
}

/**
 * Query for Artists
 */
function queryArtists() {
    $pdo = openConnection();
    $sql = "SELECT * FROM `artists` ORDER BY `artists`.`LastName` ASC";
    $result = $pdo->query($sql);
    while ($record = $result->fetch()) {
        $artists[] = new Artist($record);
    }
    closeConnection();
    return $artists;
}

/**
 * Query for Galleries
 */
function queryMuseums() {
    $pdo = openConnection();
    $sql = "SELECT * FROM `galleries` ORDER BY `galleries`.`GalleryName` ASC";
    $result = $pdo->query($sql);
    while ($record = $result->fetch()) {
        $museums[] = new Museum($record);
    }
    closeConnection();
    return $museums;
}

/**
 * Query for Shapes
 */
function queryShapes() {
    $pdo = openConnection();
    $sql = "SELECT * FROM `shapes` ORDER BY `shapes`.`ShapeName` ASC";
    $result = $pdo->query($sql);
    while ($record = $result->fetch()) {
        $shapes[] = new Shape($record);
    }
    closeConnection();
    return $shapes;
}

/**
 * Query for PaintingGenres
 */
function queryPaintingGenres() {
    $pdo = openConnection();
    $sql = "SELECT * FROM `paintinggenres`";
    $result = $pdo->query($sql);
    while ($record = $result->fetch()) {
        $paintingGenres[] = new PaintingGenre($record);
    }
    closeConnection();
    return $paintingGenres;
}

/**
 * Query for Genres
 */
function queryGenres() {
    $pdo = openConnection();
    $sql = "SELECT * FROM `genres`";
    $result = $pdo->query($sql);
    while ($record = $result->fetch()) {
        $genres[] = new Genre($record);
    }
    closeConnection();
    return $genres;
}

/**
 * Query for Subjects
 */
function querySubjects() {
    $pdo = openConnection();
    $sql = "SELECT * FROM `subjects`";
    $result = $pdo->query($sql);
    while ($record = $result->fetch()) {
        $subjects[] = new Subject($record);
    }
    closeConnection();
    return $subjects;
}

/**
 * Query for PaintingSubjects
 */
function queryPaintingSubjects() {
    $pdo = openConnection();
    $sql = "SELECT * FROM `paintingsubjects`";
    $result = $pdo->query($sql);
    while ($record = $result->fetch()) {
        $paintingSubjects[] = new PaintingSubject($record);
    }
    closeConnection();
    return $paintingSubjects;
}

/**
 * Query for TypesFrames
 */
function queryTypesFrame() {
    $pdo = openConnection();
    $sql = "SELECT * FROM `typesframes` ORDER BY `Title` ASC";
    $result = $pdo->query($sql);
    while ($record = $result->fetch()) {
        $typesFrame[] = new TypesFrame($record);
    }
    closeConnection();
    return $typesFrame;
}

/**
 * Query for TypesGlass
 */
function queryTypesGlass() {
    $pdo = openConnection();
    $sql = "SELECT * FROM `typesglass` ORDER BY `typesglass`.`GlassID` ASC";
    $result = $pdo->query($sql);
    while ($record = $result->fetch()) {
        $typesGlass[] = new TypesGlass($record);
    }
    closeConnection();
    return $typesGlass;
}

/**
 * Query for TypesMatt
 */
function queryTypesMatt() {
    $pdo = openConnection();
    $sql = "SELECT * FROM `typesmatt` ORDER BY `typesmatt`.`Title` ASC";
    $result = $pdo->query($sql);
    while ($record = $result->fetch()) {
        $typesMatt[] = new TypesMatt($record);
    }
    closeConnection();
    return $typesMatt;
}

/**
 * Query for Reviews
 */
function queryReviews() {
    $pdo = openConnection();
    $sql = "SELECT * FROM `reviews`";
    $result = $pdo->query($sql);
    while ($record = $result->fetch()) {
        $reviews[] = new Reviews($record);
    }
    closeConnection();
    return $reviews;
}

/**
 * Query for filter selection for artist, gallery, or shape
 */
function querySelectFilter() {
    $selected = "";
    $pdo = openConnection();
    $sql = "SELECT * FROM `paintings`, `artists` WHERE `paintings`.`ArtistID`=`artists`.`ArtistID` ORDER BY `YearOfWork` ASC LIMIT 20";
    $result = $pdo->query($sql);
    while ($record = $result->fetch()) {
        $paintings[] = new Painting($record);
    }
    if (isset($_POST["submit"])) {
        if (!empty($_POST["Artist"])) {
            $selected = $_POST["Artist"];
            $sql = "SELECT * FROM `paintings`, `artists` WHERE `paintings`.`ArtistID`=`artists`.`ArtistID` AND `Artists`.`LastName`='$selected' ORDER BY `YearOfWork` ASC LIMIT 20";
            $result = $pdo->query($sql);
            while ($record = $result->fetch()) {
                $newPaintings[] = new Painting($record);
            }
        }
        else if (!empty($_POST["Museum"])) {
            $selected = $_POST["Museum"];
            $sql = "SELECT * FROM `paintings`, `galleries`, `artists` WHERE `paintings`.`ArtistID`=`artists`.`ArtistID` AND `paintings`.`GalleryID`=`galleries`.`GalleryID` and `galleries`.`GalleryName`='$selected' ORDER BY `YearOfWork` ASC LIMIT 20";
            $result = $pdo->query($sql);
            while ($record = $result->fetch()) {
                $newPaintings[] = new Painting($record);
            }
        }
        else if (!empty($_POST["Shape"])) {
            $selected = $_POST["Shape"];
            $sql = "SELECT * FROM `paintings`, `shapes`, `artists` WHERE `paintings`.`ArtistID`=`artists`.`ArtistID` AND `shapes`.`ShapeID`=`paintings`.`ShapeID` and `shapes`.`ShapeName`='$selected' ORDER BY `YearOfWork` ASC LIMIT 20";
            $result = $pdo->query($sql);
            while ($record = $result->fetch()) {
                $newPaintings[] = new Painting($record);
            }
        } else {
            $newPaintings = $paintings;
        }
    } else {
        $newPaintings = $paintings;
    }
    closeConnection();
    return $newPaintings;
}

/**
 * Output the selections for artist filter dropdown options
 */
function outputArtist() {
    echo '<option value="" disable selected>Select Artist</option>';
    foreach (queryArtists() as $artist) {
        echo '<option value="'. $artist->artistLastName . '">' . $artist->artistLastName . '</option>';
    }
}

/**
 * Output the selections for museum filter dropdown options
 */
function outputMuseum() {
    echo '<option value="" disable selected>Select Museum</option>';
    foreach (queryMuseums() as $museam) {
        echo '<option value="' . $museam->galleryName . '">' . $museam->galleryName . '</option>';
    }
}

/**
 * Output the selections for shape filter dropdown options
 */
function outputShape() {
    echo '<option value="" disable selected>Select Shape</option>  ';
    foreach (queryShapes() as $shape) {
        echo '<option value="' .  $shape->shapeName . '">' . $shape->shapeName . '</option>';
    }
}

/**
 * Output top 20 paintings for the art store browse-painting page
 */
function outputPainting($selectFilter) {
    foreach ($selectFilter as $painting) {
        echo '<ul class="ui divided items" id="paintingsList">';
        echo '<li class="item">';
        echo '<a class="ui small image" href="single-paintings.php?id=' . $painting->paintingID . '"><img src="images/art/works/square-medium/' . $painting->imageFileName . '.jpg"></a>';
        echo '<div class="content">';
        echo '<a class="header" href="single-paintings.php?id=' . $painting->paintingID . '">' . $painting->title . '</a>';
        echo '<div class="meta"><span class="cinema">' . $painting->artistFirstName . ' ' .$painting->artistLastName . '</span></div>';       
        echo '<div class="description">';
        echo '<p>' . $painting->excerpt . '</p>';
        echo '</div>';
        echo '<div class="meta">';
        echo '<strong>$' . number_format($painting->msrp, 0 , "", ",") .'</strong>';      
        echo '</div>';
        echo '<div class="extra">';
        echo '<a class="ui icon orange button" href="cart.php?id=' . $painting->paintingID . '"><i class="add to cart icon"></i></a>';
        echo '<a class="ui icon button" href="addToFavorites.php?PaintingID=' . $painting->paintingID . '&ImageFileName=' . $painting->imageFileName . '&Title=' . $painting->title . '"><i class="heart icon"></i></a>';          
        echo '</div>';        
        echo '</div>';      
        echo '</li>';
        echo '</ul>';
    }
}

/**
 * Outputs reviews on the reviews tab on single-painting page
 */
function outputReview($paintingID) {
    foreach (queryReviews() as $review) {
        if ($paintingID == $review->paintingID) {
            echo '<div class="event">';
            echo    '<div class="content">';
            echo        '<div class="date">' . strtok($review->reviewDate, " ") . '</div>';
            echo        '<div class="meta">';
            echo        '<a class="like">';
            echo        reviewRating($review->rating);
            echo        '</a>';
            echo        '</div>';                    
            echo        '<div class="summary">';
            echo        $review->comment;
            echo        '</div>';       
            echo    '</div>';
            echo '</div>';
            echo '<div class="ui divider"></div>';
        }
    }
}

/**
 * Get painting from paintingID
 */
function getPainting($paintingID) {
    foreach (queryPaintings() as $painting) {
        if ($paintingID == $painting->paintingID) {
            return $painting;
        }
    }
}

/**
 * Get artist from artistID
 */
function getArtist($artistID) {
    foreach (queryArtists() as $artist) {
        if ($artistID == $artist->artistID) {
            return $artist;
        }
    }
}

/**
 * Get gallery from galleryID
 */
function getGallery($galleryID) {
    foreach (queryMuseums() as $gallery) {
        if ($galleryID == $gallery->galleryID) {
            return $gallery;
        }
    }
}

/**
 * Get painting genre from paintingID
 */
function getPaintingGenre($paintingID) {
    $pg = "";
    foreach (queryPaintingGenres() as $paintingGenre) {
        if ($paintingID == $paintingGenre->paintingID) {
            foreach (queryGenres() as $genre) {
                if ($paintingGenre->genreID == $genre->genreID) {
                    $pg .= '<li class="item"><a href="' . $genre->link  . '">' . $genre->genreName . '</a></li>';
                }
            }
        }
    }
    return $pg;
}

/**
 * Get painting subject from paintingID
 */
function getPaintingSubject($paintingID) {
    $s = "";
    foreach (queryPaintingSubjects() as $paintingSubject) {
        if ($paintingID == $paintingSubject->paintingID) {
            foreach (querySubjects() as $subject) {
                if ($paintingSubject->subjectID == $subject->subjectID) {
                    $s .= '<li class="item"><a href="#">' . $subject->subjectName . '</a></li>';
                }
            }
        }
    }
    return $s;
}

/**
 * Function constructs a string containing the <i> tags necessary to display
 * star images that reflect a rating out of 5
 */
function reviewRating($rating) {
    $iconStars = "";
    
    // first output the solid stars
    for ($i=0; $i < $rating; $i++) {
        $iconStars .= '<i class="star icon"></i>';
    }
    
    // then fill remainder with empty stars
    for ($i=$rating; $i < 5; $i++) {
        $iconStars .= '<i class="empty star icon"></i>';
    }    
    
    return $iconStars;    
}

/**
 * Function constructs a string containing the <i> tags necessary to display
 * star images that reflect a rating out of 5 for overall painting review
 */
function paintingRating($paintingID) {
    $rating = orangeStars($paintingID);
    $iconStars = "";
    
    // first output the orange stars
    for ($i=0; $i < $rating; $i++) {
        $iconStars .= '<i class="orange star icon"></i>';
    }
    
    // then fill remainder with empty stars
    for ($i=$rating; $i < 5; $i++) {
        $iconStars .= '<i class="empty star icon"></i>';
    }    
    
    return $iconStars;    
}

/**
 * Calculated the average ratings of all the reviews to generate the overall
 * painting review
 */
function orangeStars($paintingID) {
    $dividend = 0;
    $divisor = 0;
    foreach (queryReviews() as $review) {
        if ($paintingID == $review->paintingID) {
            $dividend += $review->rating;
            $divisor++;
        }
    }
    $result = $divisor == 0 ? 0 : intdiv($dividend, $divisor);
    return $result;
}

 /*
  * Displays a related works with same artist
  */
 function outputRelatedWork($artistID) {
    foreach (queryPaintings() as $painting) {
        if ($artistID == $painting->artistID) {
            echo '<div class="ui fluid card">';
            echo '<div class="ui fluid image">';
            $img = '<img src="images/art/works/square-medium/' . $painting->imageFileName . '.jpg">';
            echo constructRelatedLink($painting->paintingID, $img);
            echo '</div>';
            echo '<div class="extra">';
            echo '<h4>';
            echo constructRelatedLink($painting->paintingID, $painting->title);
            echo '</h4>';
            echo '</div>';
            echo '</div>'; 
        }
    }
}
 
 /* 
  * Constructs a link given the genre id and a label (which could
  * be a name or even an image tag)
  */
 function constructRelatedLink($id, $label) {
    $link = '<a href="single-paintings.php?id=' . $id . '">';
    $link .= $label;
    $link .= '</a>';
    return $link;
 }

?>