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
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public static function getRecipeByUser($id)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM recipes WHERE user_id = ?");
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}