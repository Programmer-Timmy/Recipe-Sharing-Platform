<?php

class Saved
{
    public static function getSavedByUser($id)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT user_recipes.id, recipes_id, users_id, title, description FROM user_recipes JOIN recipes on user_recipes.recipes_id = recipes.id WHERE users_id = ?");
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}