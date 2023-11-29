<?php

class Ingredients
{
    /**
     * @param $id
     * @return array|false
     */
    public static function getIngredientsByRecipeId($id)
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM recepies_ingredients join ingredients on recepies_ingredients.ingredients_id = ingredients.id WHERE recipes_id = ?");
        $stmt->bindValue(1, $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @return array|false
     */
    public static function getIngredients()
    {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM ingredients ORDER BY name ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);

    }

    /**
     * @param $recipe_id
     * @param $ingredients
     * @param $amounts
     * @return void
     */
    public static function addIngredientsToRecipe($recipe_id, $ingredients, $amounts)
    {
        global $conn;
        $i = 0;
        foreach ($ingredients as $ingredient) {
            if ($ingredient !== '') {
                $stmt = $conn->prepare("INSERT INTO recepies_ingredients (recipes_id, ingredients_id, quantity) VALUES (?, ?, ?)");
                $stmt->bindValue(1, $recipe_id);
                $stmt->bindValue(2, $ingredient);
                $stmt->bindValue(3, $amounts[$i]);
                $stmt->execute();
                $i++;
            }
        }
    }

    /**
     * @param $recipe_id
     * @return void
     */
    public static function deleteIngredientsFromRecipe($recipe_id)
    {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM recepies_ingredients WHERE recipes_id = ?");
        $stmt->bindValue(1, $recipe_id);
        $stmt->execute();
    }

}

?>