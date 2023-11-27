<?php

class Recipes
{

    public static function getRecipes()
    {
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM recipes");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function getRecipe($id)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM recipes WHERE id = ?");
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetchObject();
    }

    public static function getRecipeByUser($id)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM recipes WHERE user_id = ?");
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function getRandomRecipes()
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM recipes ORDER BY RAND() LIMIT 3");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function getRecipesByUserAndId($id, $userId)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM recipes WHERE user_id = ? AND id = ?");
        $stmt->bindValue(1, $userId);
        $stmt->bindValue(2, $id);
        $stmt->execute();
        return $stmt->fetchObject();
    }

    public static function createRecipe($title, $instructions, $description, $image, $user_id, $categories, $ingredients, $amounts)
    {
        if ($image['name'] == '') {
            $targetfile = 'img/default.png';
        } else {
            $targetfile = self::uploadImg($image);
            if ($targetfile == false) {
                return false;
            }
        }

        global $conn;
        $stmt = $conn->prepare("INSERT INTO recipes (title, instructions, description, img_url, user_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bindValue(1, $title);
        $stmt->bindValue(2, $instructions);
        $stmt->bindValue(3, $description);
        $stmt->bindValue(4, $targetfile);
        $stmt->bindValue(5, $_SESSION['userId']);
        if ($stmt->execute() == false) {
            return false;
        }


        $recipe_id = $conn->lastInsertId();

        categories::addCategoriesToRecipe($recipe_id, $categories);
        ingredients::addIngredientsToRecipe($recipe_id, $ingredients, $amounts);

        return true;
    }

    public static function updateRecipe($id, $title, $instructions, $description, $image, $user_id, $categories, $ingredients, $amounts)
    {
        $recipe = self::getRecipesByUserAndId($id, $user_id);
        if ($recipe == false) {
            return false;
        }

        if ($image['name'] != '') {
            self::deleteImg($recipe->img_url);
            $targetfile = self::uploadImg($image);
            if ($targetfile == false) {
                return false;
            }
        } else {
            $targetfile = $recipe->img_url;
        }

        global $conn;
        $stmt = $conn->prepare("UPDATE recipes SET title = ?, instructions = ?, description = ?, img_url = ? WHERE id = ?");
        $stmt->bindValue(1, $title);
        $stmt->bindValue(2, $instructions);
        $stmt->bindValue(3, $description);
        $stmt->bindValue(4, $targetfile);
        $stmt->bindValue(5, $id);
        if ($stmt->execute() == false) {
            return false;
        }

        categories::deleteCategoriesFromRecipe($id);
        ingredients::deleteIngredientsFromRecipe($id);

        categories::addCategoriesToRecipe($id, $categories);
        ingredients::addIngredientsToRecipe($id, $ingredients, $amounts);

        return true;

    }

    public static function deleteRecipe($id, $user_id)
    {
        $recipe = self::getRecipesByUserAndId($id, $user_id);

        self::deleteImg($recipe->img_url);

        categories::deleteCategoriesFromRecipe($id);
        ingredients::deleteIngredientsFromRecipe($id);

        global $conn;
        $stmt = $conn->prepare("DELETE FROM recipes WHERE id = ? and user_id = ?");
        $stmt->bindValue(1, $id);
        $stmt->bindValue(2, $user_id);
        if ($stmt->execute() == false) {
            return false;
        }


        return true;
    }

    private static function uploadImg($image)
    {
        if (!file_exists('img/' . $_SESSION['userId'])) {
            mkdir('img/' . $_SESSION['userId'], 0777, true);
        }
        $target_file = "img/" . $_SESSION['userId'] . '/' . uniqid() . basename($image["name"]);
        $check = getimagesize($image["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }
        if (file_exists($target_file)) {

            $uploadOk = 0;
        }
        if ($image["size"] > 500000) {
            $uploadOk = 0;
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

    private static function deleteImg($image)
    {
        if ($image != 'img/default.png') {
            unlink($image);
        }
    }
}