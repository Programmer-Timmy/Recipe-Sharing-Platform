<?php

class categories
{

        public static function getCategoriesByRecipes($id)
        {
            global $conn;
            $stmt = $conn->prepare("SELECT categories.id, categories.name FROM recipes_categories JOIN categories on recipes_categories.categories_id = categories.id JOIN recipes on recipes_categories.recipes_id = recipes.id WHERE recipes.id = ?");
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

    public static function getAllCategories()
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function addCategoriesToRecipe($recipe_id, $categories)
    {
        global $conn;
        foreach ($categories as $category) {
            $stmt = $conn->prepare("INSERT INTO recipes_categories (recipes_id, categories_id) VALUES (?, ?)");
            $stmt->bindValue(1, $recipe_id);
            $stmt->bindValue(2, $category);
            $stmt->execute();
        }
    }

    public static function deleteCategoriesFromRecipe($recipe_id)
    {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM recipes_categories WHERE recipes_id = ?");
        $stmt->bindValue(1, $recipe_id);
        $stmt->execute();
    }
}