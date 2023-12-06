<?php
$users = User::getAllUsers();
$recipes = Recipes::getRecipes();
?>

<div class="container mt-5 custom-container">
    <div class="d-flex align-items-start justify-content-between">
        <h2 class="mb-4">Commentaar</h2>
        <div>
            <a class="btn btn-primary" href="admin">Terug naar beheerdersdashboard</a>
        </div>
    </div>
    <div class="row">
        <!-- Select field for User -->
        <div class="col-md-6 mb-3">
            <label for="userSelect" class="form-label">Selecteer Gebruiker:</label>
            <select class="form-select" id="userSelect" name="user">
                <option value="0">selecteer gebruikers</option>
                <?php foreach ($users as $user) : ?>
                    <option value="<?= $user->id ?>"><?= $user->username ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Select field for Recipe -->
        <div class="col-md-6 mb-3">
            <label for="recipeSelect" class="form-label">Selecteer Recept:</label>
            <select class="form-select" id="recipeSelect" name="recipe">
                <option value="0">selecteer recept</option>
                <?php foreach ($recipes as $recipe) : ?>
                    <option value="<?= $recipe->id ?>"><?= $recipe->title ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <div id="search-results">

    </div>
</div>

<script src="js/commentsSearch.js"></script>
