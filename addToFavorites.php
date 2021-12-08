<?php
    
    include_once 'includes/session.inc.php';

    $paintingID = $_GET["PaintingID"];
    $imageFileName = $_GET["ImageFileName"];
    $title = $_GET["Title"];

    /**
     * Add painting to session, otherwise make new session then add current session
     */
    if (!isset($_SESSION["favorites"])) {
        $_SESSION["favorites"] = array();
        $_SESSION["counter"] = 0;
    }
    if (!in_array(array($paintingID, $imageFileName, $title), $_SESSION["favorites"])) {
        array_push($_SESSION["favorites"], array($paintingID, $imageFileName, $title));
        $_SESSION["counter"]++;
    }

    // After adding, redirect back
    header("Location: view-favorites.php");
    exit();
    
?>