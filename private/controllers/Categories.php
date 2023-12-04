<?php

class categories
{
    /**
     * @param $id
     * @return array|false
     */
    public static function getCategoriesByRecipes($id, $limit = 4)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT categories.id, categories.name FROM recipes_categories JOIN categories on recipes_categories.categories_id = categories.id JOIN recipes on recipes_categories.recipes_id = recipes.id WHERE recipes.id = ? LIMIT $limit");
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

    /**
     * @return array|false
     */
    public static function getRandomCategories()
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM categories ORDER BY RAND() LIMIT 6");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @return array|false
     */
    public static function getAllCategories()
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM categories ORDER BY name ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @param $recipe_id
     * @param $categories
     * @return void
     */
    public static function addCategoriesToRecipe($recipe_id, $categories)
    {
        global $conn;

        if (!is_array($categories)) {
            $stmt = $conn->prepare("INSERT INTO recipes_categories (recipes_id, categories_id) VALUES (?, ?)");
            $stmt->bindValue(1, $recipe_id);
            $stmt->bindValue(2, $categories);
            return $stmt->execute();
        } else {
        foreach ($categories as $category) {
            if ($category !== '') {
                $stmt = $conn->prepare("INSERT INTO recipes_categories (recipes_id, categories_id) VALUES (?, ?)");
                $stmt->bindValue(1, $recipe_id);
                $stmt->bindValue(2, $category);
                $stmt->execute();
            }
        }
        }
    }

    /**
     * @param $recipe_id
     * @return void
     */
    public static function deleteCategoriesFromRecipe($recipe_id)
    {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM recipes_categories WHERE recipes_id = ?");
        $stmt->bindValue(1, $recipe_id);
        $stmt->execute();
    }

    /**
     * @param $recipe_id
     * @param $categorie_id
     * @return bool
     */
    public static function deleteCategorieFromRecipe($recipe_id, $categorie_id)
    {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM recipes_categories WHERE recipes_id = ? AND categories_id = ?");
        $stmt->bindValue(1, $recipe_id);
        $stmt->bindValue(2, $categorie_id);
        return $stmt->execute();
    }

    public static function deleteByUserId($id)
    {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}