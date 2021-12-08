<?php

include_once 'includes/config.inc.php';

/*
 * Open connecton to the database
 */
function openConnection() {
    $host = DBHOST;
    $name = DBNAME;
    $user = DBUSER;
    $pass = DBPASS;
    $charset = CHARSET;

    try {
        $connString = "mysql:host=$host;dbname=$name;charset=$charset;";
        $pdo = new PDO($connString, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
        die($e->getMessage());
    }
    return $pdo;
}

/*
 * Close connecton to the database
 */
function closeConnection() {
    $pdo = null;
}

?>