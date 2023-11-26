<?php

class categories
{

        public static function getCategoriesByRecipes($id)
        {
            global $conn;
            $stmt = $conn->prepare("SELECT categories.name FROM recipes_categories JOIN categories on recipes_categories.categories_id = categories.id JOIN recipes on recipes_categories.recipes_id = recipes.id WHERE recipes.id = ?");
            $stmt->bindValue(1, $id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

    public static function getRandomCategories()
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM categories ORDER BY RAND() LIMIT 6");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}