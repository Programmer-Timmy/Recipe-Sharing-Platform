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
    <h2 class="mb-4 text-center">Welkom bij het Beheerdersdashboard</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Recepten</h5>
                    <p class="card-text">Beheer recepten in het beheerderspaneel.</p>
                    <a href="admin_recipes" class="btn btn-primary">Ga naar Recepten</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Gebruikers</h5>
                    <p class="card-text">Beheer gebruikers in het beheerderspaneel.</p>
                    <a href="admin_users" class="btn btn-primary">Ga naar Gebruikers</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Commentaar</h5>
                    <p class="card-text">Beheer commentaren in het beheerderspaneel.</p>
                    <a href="admin_comments" class="btn btn-primary">Ga naar Commentaren</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Landen</h5>
                    <p class="card-text">Beheer landen in het beheerderspaneel.</p>
                    <a href="admin_countries" class="btn btn-primary">Ga naar Landen</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Categorieën</h5>
                    <p class="card-text">Beheer categorieën in het beheerderspaneel.</p>
                    <a href="admin_categories" class="btn btn-primary">Ga naar Categorieën</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ingrediënten</h5>
                    <p class="card-text">Beheer ingrediënten in het beheerderspaneel.</p>
                    <a href="admin_ingredients" class="btn btn-primary">Ga naar Ingrediënten</a>
                </div>
            </div>
        </div>
    </div>
</div>
