<?php
if (!isset($_SESSION['userId'])) {
    setcookie('redirect', 'admin_recipeIngredients?id=' . $_GET['id'], time() + 3600, '/');
    header('location: login');
    exit();
} elseif (!isset($_SESSION['admin'])) {
    header('location: home');
    exit();
}

$error = false;
$ingredients = Ingredients::getIngredientsByRecipeId($_GET['id']);
$recipe = Recipes::getRecipe($_GET['id']);
$allIngredients = Ingredients::getIngredients();

if ($_POST) {
    Ingredients::addIngredientToRecipe($_GET['id'], $_POST['ingredientId'], $_POST['amount']);
    header('location: admin_recipeIngredients?id=' . $_GET['id']);
}

if (isset($_GET['delete'])) {
    if (Ingredients::deleteIngredientFromRecipe($_GET['id'], $_GET['delete'])) {
        header('location: admin_recipeIngredients?id=' . $_GET['id']);
    } else {
        $error = "Er is iets fout gegaan met het verwijderen van het ingrediënt";
    }
}
?>

<div class="container mt-5 custom-container">
    <div class="d-flex align-items-start justify-content-between">
        <h2 class="mb-4">Ingredients for <?php echo $recipe->title ?></h2>
        <a class="btn btn-primary" href="admin_recipes">Terug naar recepten</a>
    </div>

    <?php if ($error) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error ?>
        </div>
    <?php endif; ?>
    <table class="table">
        <thead class="table-dark">
        <tr>
            <th scope="col">Ingredient</th>
            <th scope="col">Hoeveelheid</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($ingredients as $ingredient) : ?>
            <tr>
                <td><?php echo $ingredient->name ?></td>
                <td><?php echo $ingredient->quantity ?></td>
                <td>
                    <a class="btn btn-danger"
                       href="admin_recipeIngredients?delete=<?php echo "$ingredient->id&id=$recipe->id"; ?>"
                       onclick="return confirm('Weet je het zeker dat je dit ingrediënt wilt verwijderen');">X</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <form method="post">
        <h4>Add Ingredient:</h4>
        <div class="form-group d-flex">
            <select class="form-control" id="ingredientSelect" name="ingredientId">
                <?php foreach ($allIngredients as $ingredient) :

                    // Check if the ingredient is already in the list
                    $found = false;
                    foreach ($ingredients as $ing) {
                        if ($ing->id == $ingredient->id) {
                            $found = true;
                        }
                    }
                    if ($found) {
                        continue;
                    }
                    ?>
                    <option value="<?php echo $ingredient->id ?>"><?php echo $ingredient->name ?></option>
                <?php endforeach; ?>
            </select>
            <input maxlength="30" class="form-control ml-2" type="text" name="amount" placeholder="Hoeveelheid">
            <input class="btn btn-primary ml-2" type="submit" name="recipeId" value="Toevoegen">
        </div>
    </form>
</div>
