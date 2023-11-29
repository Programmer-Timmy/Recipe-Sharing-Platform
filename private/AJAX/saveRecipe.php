<?php
require_once ('../private/config/settings.php');

    global $database;

    $servername = $database['host'];
    $username = $database['user'];
    $password = $database['password'];
    $dbname = $database['database'];
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    $search = $_GET['query'];

    global $conn;

$isSaved = Saved::isSaved($search, $_SESSION['userId']);

if ($isSaved == null) {
    Saved::saveRecipe($search, $_SESSION['userId']);
    Recipes::addLike($search);
    } else {
    Saved::deleteSavedRecipe($search, $_SESSION['userId']);
    Recipes::removeLike($search);
    }