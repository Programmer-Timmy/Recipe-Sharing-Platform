<?php
$error = false;
if (!isset($_SESSION['userId'])) {
    setcookie('redirect', 'addRecipe', time() + 3600, '/');
    header('Location: /login');
}
$categories = Categories::getAllCategories();
$ingredients = Ingredients::getIngredients();

if ($_POST) {
    if (Recipes::createRecipe($_POST['title'], $_POST['instructions'], $_POST['description'], $_FILES['image'], $_SESSION['userId'], $_POST['categories'], $_POST['ingredients'], $_POST['ingredient_amount'])) {
        header('Location: account');
    } else {
        $error = true;
    };
}
?>

<div class="container mt-4">

    <form method="post" enctype="multipart/form-data">
        <?php if ($error) {
            echo '<div class="alert alert-danger" role="alert">Er is iets misgegaan met het toevoegen van het recept.</div>';
        } ?>
        <div class="mb-3">
            <label for="title" class="form-label">Titel</label>
            <input type="text" id="title" name="title" required class="form-control">
        </div>

        <div class="mb-3">
            <label for="instructions" class="form-label">Instructies</label>
            <textarea class="form-control" id="instructions" required name="instructions" rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Beschrijving</label>
            <textarea class="form-control" id="description" required name="description" rows="4"></textarea>
        </div>

        <div class="mb-3">
            <label for="categories" class="form-label">Categorieën</label>
            <div id="categories-list" class="mb-3">
                <div class="input-group">
                    <select class="form-select" id="categories" name="categories[]" required>
                        <?php foreach ($categories as $category) {
                            echo "<option value='$category->id'>" . $category->name . "</option>";
                        } ?>
                    </select>
                    <button class="btn btn-secondary" type="button" onclick="addCategories()">Voeg Categorie Toe
                    </button>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="ingredients" class="form-label">Ingrediënten en hoeveelheden</label>
            <div id="ingredient-list" class="mb-3">
                <div class="input-group">
                    <select class="form-select" id="ingredients" name="ingredients[]" required>
                        <?php foreach ($ingredients as $ingredient) {
                            echo "<option value='$ingredient->id'>" . $ingredient->name . "</option>";
                        } ?>
                    </select>
                    <input type="text" name="ingredient_amount[]" class="form-control" placeholder="Hoeveelheid">
                    <button class="btn btn-secondary" type="button" onclick="addIngredient()">Voeg Ingrediënt Toe
                    </button>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Afbeelding</label>
            <input type="file" id="image" name="image" accept="image/png, image/jpeg, image/gif" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Toevoegen</button>
    </form>
</div>

<!-- Add Bootstrap 5 JS and Popper.js scripts here -->


<script>
    var categoryIdCounter = 1; // Unique identifier for category select elements
    var ingredientIdCounter = 1; // Unique identifier for ingredient select elements

    function addCategories() {
        var categoriesList = document.getElementById('categories-list');
        var newCategoriesItem = document.createElement('div');
        newCategoriesItem.className = 'input-group';
        newCategoriesItem.innerHTML = '<select class="form-select mt-2" id="categories' + categoryIdCounter + ';"name="categories[]" required>' +
            '<?php foreach ($categories as $category) {
                echo "<option value=\'$category->id\' >" . $category->name . "</option>";
            } ?>' +
            '</select>' +
            '<button class="btn btn-secondary mt-2" type="button" onclick="removeCategories(this.parentNode)">Verwijder Categorie</button>';
        categoriesList.appendChild(newCategoriesItem);
        categoryIdCounter++;
    }

    function addIngredient() {
        var ingredientList = document.getElementById('ingredient-list');
        var newIngredientItem = document.createElement('div');
        newIngredientItem.className = 'input-group';
        newIngredientItem.innerHTML = '<select class="form-select mt-2" id="ingredients' + ingredientIdCounter + '" name="ingredients[]" required>' +
            '<?php foreach ($ingredients as $ingredient) {
                echo "<option value=\'$ingredient->id\' >" . $ingredient->name . "</option>";
            } ?>' +
            '</select>' +
            '<input type="text" name="ingredient_amount[]" class="form-control mt-2" placeholder="Hoeveelheid">' +
            '<button class="btn btn-secondary mt-2" type="button" onclick="removeIngredient(this.parentNode)">Verwijder Ingrediënt</button>';
        ingredientList.appendChild(newIngredientItem);
        ingredientIdCounter++;
    }

    function removeCategories(element) {
        element.parentNode.removeChild(element);
    }

    function removeIngredient(element) {
        element.parentNode.removeChild(element);
    }
</script>

