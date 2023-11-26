<?php

class Ingredients
{
public static function getIngredientsByRecipeId($id)
{
global $conn;
$stmt = $conn->prepare("SELECT * FROM recepies_ingredients join ingredients on recepies_ingredients.ingredients_id = ingredients.id WHERE recipes_id = ?");
$stmt->bindValue(1, $id);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_OBJ);
}
}