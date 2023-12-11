<?php
$error = false;

if (!isset($_SESSION['userId'])) {
    setcookie('redirect', 'admin_categories', time() + 3600, '/');
    header('Location: login');
    exit();
} elseif (!isset($_SESSION['admin'])) {
    header('Location: home');
    exit();
}

if ($_POST) {
    categories::addCategory($_POST['name']);
}

if (isset($_GET['id'])) {
    if (!categories::deleteCategory($_GET['id'])) {
        $error = true;
    } else {
        header('Location: admin_categories');
    }
}

$categories = categories::getAllCategories();

?>

<div class="container mt-5 custom-container">
    <div class="d-flex align-items-start justify-content-between">
        <h2 class="mb-4">Categorieën</h2>
        <div>
            <a class="btn btn-primary" href="admin">Terug naar beheerdersdashboard</a>
        </div>
    </div>
    <form method="post" class="row g-3">
        <div class="col-md-6 mb-3">
            <label for="category" class="form-label">Categorie:</label>
            <input type="text" class="form-control" id="category" name="name">
        </div>
        <div class="col-md-6 mb-3">
            <label for="category" class="form-label">&nbsp;</label>
            <input type="submit" class="form-control btn btn-primary" value="Toevoegen" id="category" name="category">
        </div>
    </form>
    <?php if ($error) : ?>
        <div class="alert alert-danger" role="alert">
            Er is iets fout gegaan bij het verwijderen van de categorie.
        </div>
    <?php endif; ?>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">Categorie</th>
                <th scope="col">Verwijderen</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($categories as $category) : ?>
                <tr>
                    <td><?= $category->name ?></td>
                    <td>
                        <a href="admin_categories?id=<?= $category->id ?>" class="btn btn-danger">Verwijderen</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
