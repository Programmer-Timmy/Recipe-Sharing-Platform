<?php
if (!isset($_SESSION['userId'])) {
    setcookie('redirect', 'admin', time() + 3600, '/');
    header('Location: login');
    exit();
} elseif (!isset($_SESSION['admin'])) {
    header('Location: home');
    exit();
}

?>

<div class="container mt-5" id="admin">
    <h2 class="mb-4 text-center">Welcome to the Admin Dashboard</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Recepten</h5>
                    <p class="card-text">Manage recipes in the admin panel.</p>
                    <a href="admin_recipes" class="btn btn-primary">Go to Recipes</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Gebruikers</h5>
                    <p class="card-text">Manage users in the admin panel.</p>
                    <a href="admin_users" class="btn btn-primary">Go to Users</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Commentaar</h5>
                    <p class="card-text">Manage comments in the admin panel.</p>
                    <a href="admin_comments" class="btn btn-primary">Go to Comments</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Countries</h5>
                    <p class="card-text">Manage countries in the admin panel.</p>
                    <a href="admin_countries" class="btn btn-primary">Go to Countries</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Categories</h5>
                    <p class="card-text">Manage categories in the admin panel.</p>
                    <a href="admin_categories" class="btn btn-primary">Go to Categories</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ingredients</h5>
                    <p class="card-text">Manage ingredients in the admin panel.</p>
                    <a href="admin_ingredients" class="btn btn-primary">Go to Ingredients</a>
                </div>
            </div>
        </div>
    </div>
</div>