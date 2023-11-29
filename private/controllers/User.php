<?php

class user
{
    /**
     * @param $email
     * @param $password
     * @return bool
     */
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

    /**
     * @param $id
     * @return $0|false|object|stdClass|null
     */
    public static function getUserById($id){
        global $conn;
        $stmt = $conn->prepare("SELECT users.id, username, email, firstname, lastname, description, img_url, name as country  FROM users join countries on users.country_id = countries.id WHERE users.id = ?");
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetchObject();
    }

    /**
     * @param $id
     * @param $recipeId
     * @return string
     */
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

    /**
     * @param $username
     * @param $lastname
     * @param $firstname
     * @param $email
     * @param $password
     * @param $country
     * @return true
     */
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

    public static function updateUserPage($username, $bio, $image, $id)
    {
        $user = self::getUserById($id);
        if ($image['name'] !== '') {
            if ($user->img_url !== 'img/defaultProfilePic.jpg') {
                self::deleteImg($user->img_url);
            }
            $image = self::uploadImg($image);
            if ($image == false) {
                return false;
            }
        } else {
            $image = $user->img_url;
        }
        global $conn;
        $stmt = $conn->prepare("UPDATE users SET username = ?, description = ?, img_url = ? WHERE id = ?");
        $stmt->bindValue(1, htmlspecialchars($username));
        $stmt->bindValue(2, htmlspecialchars($bio));
        $stmt->bindValue(3, $image);
        $stmt->bindValue(4, $id);
        $stmt->execute();

        return true;
    }

    private static function uploadImg($image)
    {
        if (!file_exists('img/' . $_SESSION['userId'])) {
            mkdir('img/' . $_SESSION['userId'], 0777, true);
        }
        $target_dir = "img/" . $_SESSION['userId'] . "/" . uniqid();
        $target_file = $target_dir . basename($image["name"]);
        var_dump($target_file);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $target_file = $target_dir . uniqid() . '.' . $imageFileType;
        $check = getimagesize($image["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            return false;
        }
        if (file_exists($target_file)) {
            return false;
        }
        if ($image["size"] > 500000) {
            return false;
        }
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            return false;
        }
        if ($uploadOk == 0) {
            return false;
        } else {
            if (move_uploaded_file($image["tmp_name"], $target_file)) {
                return $target_file;
            } else {
                return false;
            }
        }
    }

    private static function deleteImg($img_url)
    {
        if (file_exists($img_url)) {
            unlink($img_url);
        }
    }
}

