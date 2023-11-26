<?php

class user
{
public static function login($email, $password){
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bindValue(1, $email);
    $stmt->execute();
    $user = $stmt->fetchObject();
    var_dump($user);
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
}

