<?php
$error = false;

if (!isset($_SESSION['userId'])) {
    setcookie('redirect', 'admin_ingredients', time() + 3600, '/');
    header('Location: login');
    exit();
} elseif (!isset($_SESSION['admin'])) {
    header('Location: home');
    exit();
}

if ($_POST) {
    ingredients::addIngredient($_POST['name']);
}

if (isset($_GET['id'])) {
    if (!ingredients::deleteIngredient($_GET['id'])) {
        $error = true;
    } else {
        header('Location: admin_ingredients');
    }
}

$ingredients = ingredients::getIngredients();

?>

<div class="container mt-5 custom-container">
    <div class="d-flex align-items-start justify-content-between">
        <h2 class="mb-4">Ingrediënten</h2>
        <div>
            <a class="btn btn-primary" href="admin">Terug naar beheerdersdashboard</a>
        </div>
    </div>
    <form method="post" class="row g-3">
        <div class="col-md-6 mb-3">
            <label for="name" class="form-label">Ingrediëntnaam:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="ingredient" class="form-label">&nbsp;</label>
            <input type="submit" class="form-control btn btn-primary" value="Toevoegen" id="ingredient"
                   name="ingredient">
        </div>
    </form>
    <?php if ($error) : ?>
        <div class="alert alert-danger" role="alert">
            Er is iets fout gegaan bij het verwijderen van het ingrediënt.
        </div>
    <?php endif; ?>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">Ingrediënt</th>
                <th scope="col">Verwijderen</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($ingredients as $ingredient) : ?>
                <tr>
                    <td><?= $ingredient->name ?></td>
                    <td>
                        <a href="admin_ingredients?id=<?= $ingredient->id ?>" class="btn btn-danger">Verwijderen</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
