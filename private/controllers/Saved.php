<?php

class Saved
{
    /**
     * @param $recipe_id
     * @param $user_id
     * @return bool
     */
    public static function getSavedByUser($id)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT user_recipes.id, recipes_id, users_id, title, description, img_url FROM user_recipes JOIN recipes on user_recipes.recipes_id = recipes.id WHERE users_id = ?");
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @param $recipe_id
     * @param $user_id
     * @return $0|false|object|stdClass|null
     */
    public static function isSaved($recipe_id, $user_id)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM user_recipes WHERE recipes_id = ? AND users_id = ?");
        $stmt->bindValue(1, $recipe_id);
        $stmt->bindValue(2, $user_id);
        $stmt->execute();
        return $stmt->fetchObject();
    }

    /**
     * @param $recipe_id
     * @param $user_id
     * @return void
     */
    public static function saveRecipe($recipe_id, $user_id)
    {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO user_recipes (users_id, recipes_id) VALUES (?,?)");
        $stmt->bindValue(1, $user_id);
        $stmt->bindValue(2, $recipe_id);
        $stmt->execute();
    }

    /**
     * @param $recipe_id
     * @param $user_id
     * @return void
     */
    public static function deleteSavedRecipe($recipe_id, $user_id)
    {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM user_recipes WHERE users_id = ? AND recipes_id = ?");
        $stmt->bindValue(1, $user_id);
        $stmt->bindValue(2, $recipe_id);
        $stmt->execute();
    }
}