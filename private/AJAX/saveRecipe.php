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

    $stmt = $conn->prepare("SELECT * FROM user_recipes WHERE users_id LIKE ? and recipes_id LIKE ?");
    $stmt->bindValue(1, $_SESSION['userId']);
    $stmt->bindValue(2, $search);
    $stmt->execute();
    if ($stmt->fetchObject() == null) {
        $stmt = $conn->prepare("INSERT INTO user_recipes (users_id, recipes_id) VALUES (?,?)");
        $stmt->bindValue(1, $_SESSION['userId']);
        $stmt->bindValue(2, $search);
        $stmt->execute();

        $stmt = $conn->prepare("UPDATE recipes SET likes = likes + 1 WHERE id = ?");
        $stmt->bindValue(1, $search);
        $stmt->execute();
    } else {
        $stmt = $conn->prepare("DELETE FROM user_recipes WHERE users_id LIKE ? and recipes_id LIKE ?");
        $stmt->bindValue(1, $_SESSION['userId']);
        $stmt->bindValue(2, $search);
        $stmt->execute();

        $stmt = $conn->prepare("UPDATE recipes SET likes = likes - 1 WHERE id = ?");
        $stmt->bindValue(1, $search);
        $stmt->execute();
    }