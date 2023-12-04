<?php
if (!isset($_SESSION['userId'])) {
    setcookie('redirect', 'admin_recipeCategories?id=' . $_GET['id'], time() + 3600, '/');
    header('location: login');
    exit();
} elseif ($_SESSION['admin'] != true) {
    header('location: home');
    exit();
}
$error = false;
$categories = Categories::getCategoriesByRecipes($_GET['id'], 100);
$recipe = Recipes::getRecipe($_GET['id']);
$allCategories = Categories::getAllCategories();

if ($_POST) {
    if (categories::addCategoriesToRecipe($_GET['id'], $_POST['categoryId'])) {
        header('location: admin_recipeCategories?id=' . $_GET['id']);
    } else {
        $error = "Er is iets fout gegaan met het toevoegen van de categorie";
    }
}
if (isset($_GET['delete'])) {

    if (categories::deleteCategorieFromRecipe($_GET['id'], $_GET['delete'])) {
        header('location: admin_recipeCategories?id=' . $_GET['id']);
    } else {
        $error = "Er is iets fout gegaan met het verwijderen van de categorie";
    }
}
?>

<div class="container mt-5 custom-container">
    <div class="d-flex align-items-start justify-content-between">
        <h2 class="mb-4">Categories for <?php echo $recipe->title ?></h2>
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
            <th scope="col">Category Name</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($categories as $category) : ?>
            <tr>
                <td><?php echo $category->name ?></td>
                <td><a class="btn btn-danger"
                       href="admin_recipeCategories?delete=<?php echo "$category->id&id=$recipe->id"; ?>"
                       onclick="return confirm('Weet je het zeker dat je deze categorie wilt verwijderen');">X</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <form method="post">
        <h4>Add Category:</h4>
        <div class="form-group d-flex">
            <select class="form-control" id="categorySelect" name="categoryId">
                <?php foreach ($allCategories as $category) :

                    // make a check that the category is not already in the list
                    $found = false;
                    foreach ($categories as $cat) {
                        if ($cat->id == $category->id) {
                            $found = true;
                        }
                    }
                    if ($found) {
                        continue;
                    }
                    ?>
                    <option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
                <?php endforeach; ?>
            </select>
            <input class="btn btn-primary ml-2" type="submit" name="recipeId" value="Toevoegen">
        </div>
    </form>
</div>