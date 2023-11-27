<?php

class user
{
public static function login($email, $password){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bindValue(1, $email);
    $stmt->execute();
    $user = $stmt->fetchObject();
    if($user == null){
        return false;
    }else{
        if(password_verify($password, $user->password_hash)){
            $_SESSION['userId'] = $user->id;
            return true;
        }else{
            return false;

        }
    }
}

    public static function getUserById($id){
        global $conn;
        $stmt = $conn->prepare("SELECT users.id, username, email, firstname, lastname, description, img_url, name as country  FROM users join countries on users.country_id = countries.id WHERE users.id = ?");
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetchObject();
    }

    public static function getUserLikes($id, $recipeId){
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM user_recipes WHERE users_id = ? AND recipes_id = ?");
        $stmt->bindValue(1, $id);
        $stmt->bindValue(2, $recipeId);
        $stmt->execute();
        if ($stmt->fetchAll(PDO::FETCH_ASSOC) == null) {
            return "";
        } else {
            return "liked";
        }
    }

    public static function register($username, $lastname, $firstname, $email, $password, $country)
    {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO users (username, lastname, firstname, email, password_hash, country_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bindValue(1, htmlspecialchars($username));
        $stmt->bindValue(2, htmlspecialchars($lastname));
        $stmt->bindValue(3, htmlspecialchars($firstname));
        $stmt->bindValue(4, htmlspecialchars($email));
        $stmt->bindValue(5, password_hash($password, PASSWORD_DEFAULT));
        $stmt->bindValue(6, $country);
        $stmt->execute();

        return true;
    }
}

