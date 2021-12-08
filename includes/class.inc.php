<?php 

class Painting {
    public $paintingID;
    public $artistID;
    public $galleryID;
    public $imageFileName;
    public $title;
    public $shapeID;
    public $museumLink;
    public $accessionNumber;
    public $copyright;
    public $description;
    public $excerpt;
    public $yearOfWork;
    public $width;
    public $height;
    public $medium;
    public $msrp;
    public $googleLink;
    public $googleDescription;
    public $wikiLink;
    public $artistFirstName;
    public $artistLastName;

    function __construct($record) {
        $this->paintingID = $record["PaintingID"];
        $this->artistID = $record["ArtistID"];
        $this->galleryID = $record["GalleryID"];
        $this->imageFileName = $record["ImageFileName"];
        $this->title = $record["Title"];
        $this->shapeID = $record["ShapeID"];
        $this->museumLink = $record["MuseumLink"];
        $this->accessionNumber = $record["AccessionNumber"];
        $this->copyright = $record["CopyrightText"];
        $this->description = $record["Description"];
        $this->excerpt = $record["Excerpt"];
        $this->yearOfWork = $record["YearOfWork"];
        $this->width = $record["Width"];
        $this->height = $record["Height"];
        $this->medium = $record["Medium"];
        $this->msrp = $record["MSRP"];
        $this->googleLink = $record["GoogleLink"];
        $this->googleDescription = $record["GoogleDescription"];
        $this->wikiLink = $record["WikiLink"];
        $this->artistFirstName = $record["FirstName"];
        $this->artistLastName = $record["LastName"];
    }
}

class Artist {
    public $artistID;
    public $artistFirstName;
    public $artistLastName;
    public $artistLink;

    function __construct($record) {
        $this->artistID = $record["ArtistID"];
        $this->artistFirstName = $record["FirstName"];
        $this->artistLastName = $record["LastName"];
        $this->artistLink = $record["ArtistLink"];
    }
}

class Museum {
    public $galleryID;
    public $galleryName;
    public $galleryWebSite;

    function __construct($record) {
        $this->galleryID = $record["GalleryID"];
        $this->galleryName = $record["GalleryName"];
        $this->galleryWebSite = $record["GalleryWebSite"];
    }
}

class Shape {
    public $shapeID;
    public $shapeName;

    function __construct($record) {
        $this->shapeID = $record["ShapeID"];
        $this->shapeName = $record["ShapeName"];
    }
}

class PaintingGenre {
    public $paintingGenreID;
    public $paintingID;
    public $genreID;

    function __construct($record) {
        $this->paintingGenreID = $record["PaintingGenreID"];
        $this->paintingID = $record["PaintingID"];
        $this->genreID = $record["GenreID"];
    }
}

class Genre {
    public $genreID;
    public $genreName;
    public $eraID;
    public $description;
    public $link;

    function __construct($record) {
        $this->genreID = $record["GenreID"];
        $this->genreName = $record["GenreName"];
        $this->eraID = $record["Description"];
        $this->link = $record["Link"];
    }
}

class Subject {
    public $subjectID;
    public $subjectName;

    function __construct($record) {
        $this->subjectID = $record["SubjectID"];
        $this->subjectName = $record["SubjectName"];
    }
}

class PaintingSubject {
    public $paintingSubjectID;
    public $paintingID;
    public $subjectID;

    function __construct($record) {
        $this->paintingSubjectID = $record["PaintingSubjectID"];
        $this->paintingID = $record["PaintingID"];
        $this->subjectID = $record["SubjectID"];
    }
}

class TypesFrame {
    public $frameID;
    public $title;
    public $price;
    public $color;
    public $style;

    function __construct($record) {
        $this->frameID = $record["FrameID"];
        $this->title = $record["Title"];
        $this->price = $record["Price"];
        $this->color = $record["Color"];
        $this->style = $record["Style"];
    }
}

class TypesGlass {
    public $glassID;
    public $title;
    public $description;
    public $price;

    function __construct($record) {
        $this->glassID = $record["GlassID"];
        $this->title = $record["Title"];
        $this->description = $record["Description"];
        $this->price = $record["Price"];
    }
}

class TypesMatt {
    public $mattID;
    public $title;
    public $colorCode;

    function __construct($record) {
        $this->mattID = $record["MattID"];
        $this->title = $record["Title"];
        $this->colorCode = $record["ColorCode"];
    }
}

class Reviews {
    public $ratingID;
    public $paintingID;
    public $reviewDate;
    public $rating;
    public $comment;

    function __construct($record) {
        $this->ratingID = $record["RatingID"];
        $this->paintingID = $record["PaintingID"];
        $this->reviewDate = $record["ReviewDate"]; 
        $this->rating = $record["Rating"];
        $this->comment = $record["Comment"];
    }
}

?>