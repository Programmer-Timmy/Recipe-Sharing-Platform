<?php
$error = false;
$recipeId = $_GET['id'];

if (!isset($_SESSION['userId'])) {
    setcookie('redirect', "editRecipe?id$recipeId", time() + 3600, '/');
    header('Location: login');
} else if (!$recipe = Recipes::getRecipesByUserAndId($recipeId, $_SESSION['userId'])) {
    header('Location: account');
    exit();
}

$categories = Categories::getCategoriesByRecipes($recipe->id);
$ingredients = Ingredients::getIngredientsByRecipeId($recipe->id);

$allCategories = Categories::getAllCategories();
$allIngredients = Ingredients::getIngredients();

if ($_POST) {
    if (Recipes::updateRecipe($recipeId, $_POST['title'], $_POST['instructions'], $_POST['description'], $_FILES['image'], $_SESSION['userId'], $_POST['categories'], $_POST['ingredients'], $_POST['ingredient_amount'])) {
        header('Location: account');
    } else {
        $error = true;

    }

}
?>

<div class="container mt-4">
    <form method="post" enctype="multipart/form-data">
        <?php
        if ($error) {
            echo '<div class="alert alert-danger" role="alert">Er is iets misgegaan met het bijwerken van het recept.</div>';
        }
        ?>
        <div class="mb-3">
            <label for="title" class="form-label">Titel</label>
            <input type="text" id="title" name="title" required class="form-control"
                   value="<?php echo $recipe->title; ?>">
        </div>

        <div class="mb-3">
            <label for="instructions" class="form-label">Instructies</label>
            <textarea class="form-control" id="instructions" required name="instructions"
                      rows="4"><?php echo $recipe->instructions; ?></textarea>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Beschrijving</label>
            <textarea class="form-control" id="description" required name="description"
                      rows="4"><?php echo $recipe->description; ?></textarea>
        </div>

        <div class="mb-3">
            <label for="categories" class="form-label">Categorieën</label>
            <div id="categories-list" class="mb-3">
                <?php
                if ($categories) {
                    foreach ($categories as $category) {
                        echo '<div class="input-group mb-2">';
                        echo '<select class="form-select" name="categories[]" required>';
                        foreach ($allCategories as $cat) {
                            $selected = ($cat->id == $category->id) ? 'selected' : '';
                            echo "<option value='$cat->id' $selected>" . $cat->name . "</option>";
                        }
                        echo '</select>';
                        echo '<button class="btn btn-secondary" type="button" onclick="removeCategories(this.parentNode)">Verwijder Categorie</button>';
                        echo '</div>';
                    }
                }


                ?>
                <div class="input-group">
                    <select class="form-select" id="categories" name="categories[]">
                        <option value="">Selecteer een categorie</option>
                        <?php foreach ($allCategories as $category) {
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
                <?php
                foreach ($ingredients as $ingredient) {
                    echo '<div class="input-group mb-2">';
                    echo '<select class="form-select" name="ingredients[]" required>';
                    foreach ($allIngredients as $ing) {
                        $selected = ($ing->id == $ingredient->id) ? 'selected' : '';
                        echo "<option value='$ing->id' $selected>" . $ing->name . "</option>";
                    }
                    echo '</select>';
                    echo '<input type="text" name="ingredient_amount[]" class="form-control" placeholder="Hoeveelheid" value="' . $ingredient->quantity . '">';
                    echo '<button class="btn btn-secondary" type="button" onclick="removeIngredient(this.parentNode)">Verwijder Ingrediënt</button>';
                    echo '</div>';
                }
                ?>
                <div class="input-group">
                    <select class="form-select" id="ingredients" name="ingredients[]">
                        <option value="">Selecteer een ingrediënt</option>
                        <?php foreach ($allIngredients as $ingredient) {
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

        <button type="submit" class="btn btn-primary">Bijwerken</button>
    </form>
</div>
<script>
    var categoryIdCounter = <?php echo count($categories) + 1; ?>; // Unique identifier for category select elements
    var ingredientIdCounter = <?php echo count($categories) + 1; ?>; // Unique identifier for ingredient select elements

    function addCategories() {
        var categoriesList = document.getElementById('categories-list');
        var newCategoriesItem = document.createElement('div');
        newCategoriesItem.className = 'input-group';
        newCategoriesItem.innerHTML = '<select class="form-select mt-2" name="categories[]" required>' +
            '<?php foreach ($allCategories as $category) {
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
        newIngredientItem.innerHTML = '<select class="form-select mt-2" name="ingredients[]" required>' +
            '<?php foreach ($allIngredients as $ingredient) {
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