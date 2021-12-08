<?php 

    include_once 'includes/session.inc.php';

    $paintID = $_GET["PaintID"];

    /**
     * Remove an instance of a session in the array
     */
    if (isset($_SESSION["favorites"])) {
        $size = 0;
        foreach ($_SESSION["favorites"] as $item) {
            if ($paintID == $item[0]) {
                array_splice($_SESSION["favorites"], $size, 1);
            }
            $size++;
        }
        // Decrement favorite session counter
        if (isset($_SESSION["counter"])) {
            $_SESSION["counter"]--;
        }
    }

    /**
     * Unset the session to remove all favorites
     */
    if ($paintID == "removeAll") {
        session_unset();
        $_SESSION["counter"] = 0;
    }

    // After removing, redirect back
    header("Location: view-favorites.php");
    exit();

?>