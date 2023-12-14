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
        return 'Wachtwoord of email is onjuist';
    }else{
        if ($user->verified == 0) {
            return 'Email is nog niet geverifieerd';
        }
        if(password_verify($password, $user->password_hash)){
            if ($user->admin == 1) {
                $_SESSION['admin'] = true;
            }
            $_SESSION['userId'] = $user->id;
            return true;
        }else{
            return 'Wachtwoord of email is onjuist';

        }
    }
}

    /**
     * @param $id
     * @return $0|false|object|stdClass|null
     */
    public static function getUserById($id){
        global $conn;
        $stmt = $conn->prepare("SELECT users.id, username, email, firstname, lastname, description, img_url, name as country, country_id, admin FROM users join countries on users.country_id = countries.id WHERE users.id = ?");
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetchObject();
    }

    /**
     * @param $firstname
     * @param $lastname
     * @param $email
     * @param $country
     * @param $id
     * @return true
     */
    public static function updateUser($firstname, $lastname, $email, $country, $id)
    {
        global $conn;
        $stmt = $conn->prepare("UPDATE users SET firstname = ?, lastname = ?, email = ?, country_id = ? WHERE id = ?");
        $stmt->bindValue(1, htmlspecialchars($firstname));
        $stmt->bindValue(2, htmlspecialchars($lastname));
        $stmt->bindValue(3, htmlspecialchars($email));
        $stmt->bindValue(4, $country);
        $stmt->bindValue(5, $id);
        $stmt->execute();

        return true;
    }

    /**
     * @param $password
     * @param $id
     * @return true
     */
    public static function updateUserPassword($password, $passwordRepeat, $id)
    {
        if ($password !== $passwordRepeat) {
            return false;
        }
        if ($password == "") {
            return false;
        }
        global $conn;
        $stmt = $conn->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
        $stmt->bindValue(1, password_hash($password, PASSWORD_DEFAULT));
        $stmt->bindValue(2, $id);
        $stmt->execute();

        return true;
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
        // check if email already exists
        if (self::ifEmailExists($email)) {
            return 'Email bestaat al';
            exit();
        }
        if ($password == "") {
            return 'Wachtwoord mag niet leeg zijn';
            exit();
        }
        if ($username == "") {
            return 'Gebruikersnaam mag niet leeg zijn';
            exit();
        }
        if ($firstname == "") {
            return 'Voornaam mag niet leeg zijn';
            exit();
        }
        if ($lastname == "") {
            return 'Achternaam mag niet leeg zijn';
            exit();
        }
        if ($email == "") {
            return 'Email mag niet leeg zijn';
            exit();
        }
        if ($country == "") {
            return 'Land mag niet leeg zijn';
            exit();
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $token = uniqid();
            mail::sendEmailVerification($email, $firstname, $lastname, $token);
        } else {
            return 'Email is niet geldig';
            exit();
        }
        global $conn;
        $stmt = $conn->prepare("INSERT INTO users (username, lastname, firstname, email, password_hash, country_id, token) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bindValue(1, htmlspecialchars($username));
        $stmt->bindValue(2, htmlspecialchars($lastname));
        $stmt->bindValue(3, htmlspecialchars($firstname));
        $stmt->bindValue(4, htmlspecialchars($email));
        $stmt->bindValue(5, password_hash($password, PASSWORD_DEFAULT));
        $stmt->bindValue(6, $country);
        $stmt->bindValue(7, $token);
        $stmt->execute();

        return true;
    }

    /**
     * @param $username
     * @param $bio
     * @param $image
     * @param $id
     * @return bool
     */
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

    /**
     * @param $image
     * @return false|string
     */
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

    /**
     * @param $img_url
     * @return void
     */
    private static function deleteImg($img_url)
    {
        if (file_exists($img_url)) {
            unlink($img_url);
        }
    }

    /**
     * @return array|false
     */
    public static function getAllUsers()
    {
        global $conn;
        $stmt = $conn->prepare("SELECT users.*, countries.name FROM users join countries on users.country_id = countries.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @param $id
     * @param $username
     * @param $firstname
     * @param $lastname
     * @param $email
     * @param $description
     * @param $admin
     * @param $image
     * @param $country
     * @param $oldImgUrl
     * @return bool
     */
    public static function updateUserAdmin($id, $username, $firstname, $lastname, $email, $description, $admin, $image, $country, $oldImgUrl)
    {
        // check if image is uploaded
        if ($image['name'] !== '') {
            // delete old image if it's not the default image
            if ($oldImgUrl !== 'img/defaultProfilePic.jpg') {
                self::deleteImg($oldImgUrl);
            }
            // upload new image
            $image = self::uploadImg($image);
            if ($image == false) {
                return false;
            }
        } else {
            // keep old image
            $image = $oldImgUrl;
        }
        // update user
        global $conn;
        $stmt = $conn->prepare("UPDATE users SET firstname = ?, lastname = ?, email = ?, description = ?, admin = ?, img_url = ?, country_id = ?, username = ?  WHERE id = ?");
        $stmt->bindValue(1, htmlspecialchars($firstname));
        $stmt->bindValue(2, htmlspecialchars($lastname));
        $stmt->bindValue(3, htmlspecialchars($email));
        $stmt->bindValue(4, htmlspecialchars($description));
        $stmt->bindValue(5, $admin);
        $stmt->bindValue(6, $image);
        $stmt->bindValue(7, $country);
        $stmt->bindValue(8, htmlspecialchars($username));
        $stmt->bindValue(9, $id);
        $stmt->execute();

        return true;
    }

    /**
     * @param $id
     * @param $img_url
     * @return void
     */
    public static function deleteByUserId($id, $img_url)
    {
        try {
            // delete all recipes, comments and saved recipes by user
            Saved::deleteAllSavedByUserId($id);
            comments::deleteCommentsByUserId($id);
            Recipes::deleteAllRecipesByUserId($id);

            // delete image if it's not the default image
            if ($img_url !== 'img/defaultProfilePic.jpg') {
                self::deleteImg($img_url);
            }

            // delete user
            global $conn;
            $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
            $stmt->bindValue(1, $id);
            $stmt->execute();
            return true;
        } catch (PDOException) {
            return false;
        }
    }

    public static function addUserAdmin($username, $firstname, $lastname, $email, $description, $admin, $image, $country, $password)
    {
        // check if email already exists
        if (self::ifEmailExists($email)) {
            return 'Email bestaat al';
            exit();
        }

        // check if image is uploaded
        if ($image['name'] !== '') {
            // upload new image
            $image = self::uploadImg($image);
            if ($image == false) {
                return 'Afbeelding uploaden mislukt';
            }
        } else {
            $image = 'img/defaultProfilePic.jpg';
        }


        // update user
        global $conn;
        $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, description, admin, img_url, country_id, username, password_hash) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bindValue(1, htmlspecialchars($firstname));
        $stmt->bindValue(2, htmlspecialchars($lastname));
        $stmt->bindValue(3, htmlspecialchars($email));
        $stmt->bindValue(4, htmlspecialchars($description));
        $stmt->bindValue(5, $admin);
        $stmt->bindValue(6, $image);
        $stmt->bindValue(7, $country);
        $stmt->bindValue(8, htmlspecialchars($username));
        $stmt->bindValue(9, password_hash($password, PASSWORD_DEFAULT));
        $stmt->execute();


    }

    private static function ifEmailExists($email)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bindValue(1, $email);
        $stmt->execute();
        $user = $stmt->fetchObject();
        if ($user == null) {
            return false;
        } else {
            return true;
        }
    }

    public static function verifyUser($token)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM users WHERE token = ?");
        $stmt->bindValue(1, $token);
        $stmt->execute();
        $user = $stmt->fetchObject();
        if ($user == null) {
            return 'Gebruiker niet gevonden';
        } else {
            $stmt = $conn->prepare("UPDATE users SET token = '', verified = 1 WHERE id = ?");
            $stmt->bindValue(1, $user->id);
            $stmt->execute();
            return true;
        }
    }
}

