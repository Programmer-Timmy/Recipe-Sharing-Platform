<?php
if (!isset($_SESSION['userId'])) {
    setcookie('redirect', 'admin_recipes', time() + 3600, '/');
    header('location: login');
    exit();
} elseif ($_SESSION['admin'] != true) {
    header('location: home');
    exit();
}

if (isset($_GET['delete'])) {
    Recipes::delteRecipeAdmin($_GET['delete']);
    header('location: admin_recipes');
}

$recipes = Recipes::getRecipes();
?>

<div class="container mt-5 custom-container">
    <div class="d-flex align-items-start justify-content-between">
        <h2 class="mb-4">Recepten</h2>
        <a class="btn btn-primary" href="admin">Terug naar beheerdersdashboard</a>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead class="table-dark">
            <tr>
                <th scope="col">Titel</th>
                <th scope="col">Beschrijving</th>
                <th scope="col">Instructies</th>
                <th scope="col">Gemaakt op</th>
                <th scope="col">Gemaakt door</th>
                <th scope="col">Aantal opgeslagen</th>
                <th scope="col">Afbeelding</th>
                <th scope="col">Categorie</th>
                <th scope="col">Ingrediënten</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php

            foreach ($recipes as $recipe) {
                $date = new DateTime($recipe->created_at);
                $date = $date->format('d-m-Y H:i:s');
                echo "<tr>";
                echo "<td>" . $recipe->title . "</td>";
                echo "<td><div style='max-width: 250px; max-height: 200px; overflow-y: auto;'>" . $recipe->description . "</div></td>";
                echo "<td><div style='max-width: 250px; max-height: 200px; overflow-y: auto;'>" . $recipe->instructions . "</div></td>";
                echo "<td>" . $date . "</td>";
                echo "<td>$recipe->firstname $recipe->lastname</td>";
                echo "<td>" . $recipe->likes . "</td>";
                echo "<td><a class='btn btn-primary' href='$recipe->img_url'>Show Img</a> </td>";
                echo "<td><a class='btn btn-primary' href='admin_recipeCategories?id=$recipe->id'>Show Categories</a></td>";
                echo "<td><a class='btn btn-primary' href='admin_recipeIngredients?id=$recipe->id'>Show Ingredients</a></td>";
                echo "<td><a class='btn btn-primary' href='admin_editRecipe?id=" . $recipe->id . "' >...</a></td>
                      <td> <a class='btn btn-danger' href='admin_recipes?delete=" . $recipe->id . "' onclick=\"return confirm('Are you sure you want to delete this item?');\">X</a></td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>