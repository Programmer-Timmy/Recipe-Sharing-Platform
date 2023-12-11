<?php

class Recipes
{

    /**
     * @return array|false
     */
    public static function getRecipes()
    {
        global $conn;

        $stmt = $conn->prepare("SELECT recipes.*, users.firstname, users.lastname FROM recipes join users on recipes.user_id = users.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @param $id
     * @return $0|false|object|stdClass|null
     */
    public static function getRecipe($id)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM recipes WHERE id = ?");
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetchObject();
    }

    /**
     * @param $id
     * @return array|false
     */
    public static function getRecipeByUser($id)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM recipes WHERE user_id = ?");
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @return array|false
     */
    public static function getRandomRecipes()
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM recipes ORDER BY RAND() LIMIT 3");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @param $id
     * @param $userId
     * @return $0|false|object|stdClass|null
     */
    public static function getRecipesByUserAndId($id, $userId)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM recipes WHERE user_id = ? AND id = ?");
        $stmt->bindValue(1, $userId);
        $stmt->bindValue(2, $id);
        $stmt->execute();
        return $stmt->fetchObject();
    }

    /**
     * @param $search
     * @param $sortby
     * @return array|false
     */
    public static function getRecipesWithSearch($search, $sortby)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM recipes WHERE title LIKE ? $sortby");
        $stmt->bindValue(1, '%' . $search . '%');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @param $search
     * @param $category
     * @param $sortby
     * @return array|false
     */
    public static function getRecipesWithSearchAndCategory($search, $category, $sortby)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT recipes.id, recipes.title, recipes.description, recipes.img_url, recipes.created_at, recipes.likes FROM recipes_categories INNER JOIN recipes ON (recipes_categories.recipes_id = recipes.id) WHERE categories_id = ? AND title LIKE ? $sortby");
        $stmt->bindValue(1, $category);
        $stmt->bindValue(2, '%' . $search . '%');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function getRecipesByCategory($category)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT recipes.id, recipes.title, recipes.description, recipes.img_url, recipes.created_at, recipes.likes FROM recipes_categories INNER JOIN recipes ON (recipes_categories.recipes_id = recipes.id) WHERE categories_id = ?");
        $stmt->bindValue(1, $category);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @param $id
     * @return void
     */
    public static function addLike($id)
    {
        global $conn;
        $stmt = $conn->prepare("UPDATE recipes SET likes = likes + 1 WHERE id = ?");
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }

    /**
     * @param $id
     * @return void
     */
    public static function removeLike($id)
    {
        global $conn;
        $stmt = $conn->prepare("UPDATE recipes SET likes = likes - 1 WHERE id = ?");
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }

    /**
     * @param $title
     * @param $instructions
     * @param $description
     * @param $image
     * @param $user_id
     * @param $categories
     * @param $ingredients
     * @param $amounts
     * @return bool
     */
    public static function createRecipe($title, $instructions, $description, $image, $user_id, $categories, $ingredients, $amounts)
    {
        $targetfile = 'img/defaultImg.jpg';
        if ($image['name'] !== '') {
            $targetfile = self::uploadImg($image);
            if ($targetfile == false) {
                return false;
            }
        }

        global $conn;
        $stmt = $conn->prepare("INSERT INTO recipes (title, instructions, description, img_url, user_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bindValue(1, htmlspecialchars($title));
        $stmt->bindValue(2, htmlspecialchars($instructions));
        $stmt->bindValue(3, htmlspecialchars($description));
        $stmt->bindValue(4, htmlspecialchars($targetfile));
        $stmt->bindValue(5, $_SESSION['userId']);
        if ($stmt->execute() == false) {
            return false;
        }


        $recipe_id = $conn->lastInsertId();

        categories::addCategoriesToRecipe($recipe_id, $categories);
        ingredients::addIngredientsToRecipe($recipe_id, $ingredients, $amounts);

        return true;
    }

    /**
     * @param $id
     * @param $title
     * @param $instructions
     * @param $description
     * @param $image
     * @param $user_id
     * @param $categories
     * @param $ingredients
     * @param $amounts
     * @return bool
     */
    public static function updateRecipe($id, $title, $instructions, $description, $image, $user_id, $categories, $ingredients, $amounts)
    {
        $recipe = self::getRecipesByUserAndId($id, $user_id);
        if ($recipe == false) {
            return false;
        }

        if ($image['name'] != '') {
            if ($recipe->img_url != 'img/defaultImg.png') {
                self::deleteImg($recipe->img_url);
            }
            $targetfile = self::uploadImg($image);
            if ($targetfile == false) {
                return false;
            }
        } else {
            $targetfile = $recipe->img_url;
        }

        global $conn;
        $stmt = $conn->prepare("UPDATE recipes SET title = ?, instructions = ?, description = ?, img_url = ? WHERE id = ?");
        $stmt->bindValue(1, htmlspecialchars($title));
        $stmt->bindValue(2, htmlspecialchars($instructions));
        $stmt->bindValue(3, htmlspecialchars($description));
        $stmt->bindValue(4, htmlspecialchars($targetfile));
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

    /**
     * @param $id
     * @param $user_id
     * @return bool
     */
    public static function deleteRecipe($id, $user_id)
    {
        $recipe = self::getRecipesByUserAndId($id, $user_id);
        if (!$recipe) {
            return;
            exit();
        }
        if ($recipe->img_url != 'img/defaultImg.png') {
        self::deleteImg($recipe->img_url);
        }


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

    public static function delteRecipeAdmin($id)
    {
        $recipe = self::getRecipe($id);

        if ($recipe->img_url != 'img/defaultImg.png') {
            self::deleteImg($recipe->img_url);
        }

        categories::deleteCategoriesFromRecipe($id);
        ingredients::deleteIngredientsFromRecipe($id);

        global $conn;
        $stmt = $conn->prepare("DELETE FROM recipes WHERE id = ? ");
        $stmt->bindValue(1, $id);
        if ($stmt->execute() == false) {
            return false;
        }


        return true;
    }

    /**
     * @param $id
     * @return void
     */
    public static function deleteAllRecipesByUserId($id)
    {
        global $conn;

        //loop through all recipes
        $recipes = Recipes::getRecipeByUser($id);
        if (!$recipes) {
            return false;
        }
        foreach ($recipes as $recipe) {
            // delete image if not default image
            if ($recipe->img_url != 'img/defaultImg.jpg') {
                self::deleteImg($recipe->img_url);
            }

            // delete comments, categories, ingredients and saved recipes
            Saved::deleteAllSavedByRecipeId($recipe->id);
            comments::deleteCommentsByRecipeId($recipe->id);
            categories::deleteCategoriesFromRecipe($recipe->id);
            ingredients::deleteIngredientsFromRecipe($recipe->id);

            // delete recipe
            $stmt = $conn->prepare("DELETE FROM recipes WHERE id = ? ");
            $stmt->bindValue(1, $recipe->id);
            $stmt->execute();
        }

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

    /**
     * @param $image
     * @return void
     */
    private static function deleteImg($image)
    {
        if ($image != 'img/default.png') {
            unlink($image);
        }
    }
}