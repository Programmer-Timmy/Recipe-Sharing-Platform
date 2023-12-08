<?php
$error = false;

if (!isset($_SESSION['userId'])) {
    setcookie('redirect', 'admin_countries', time() + 3600, '/');
    header('Location: login');
    exit();
} elseif (!isset($_SESSION['admin'])) {
    header('Location: home');
    exit();
}

if ($_POST) {
    country::addCountry($_POST['country']);
}

if (isset($_GET['id'])) {
    if (!country::deleteCountry($_GET['id'])) {
        $error = true;
    } else {
        header('Location: admin_countries');
    }
}

$countries = country::getAllCountries();

?>

<div class="container mt-5 custom-container">
    <div class="d-flex align-items-start justify-content-between">
        <h2 class="mb-4">Landen</h2>
        <div>
            <a class="btn btn-primary" href="admin">Terug naar beheerdersdashboard</a>
        </div>
    </div>
    <form method="post" class="row g-3">
        <div class="col-md-6 mb-3">
            <label for="country" class="form-label">Land:</label>
            <input type="text" class="form-control" id="country" name="country">
        </div>
        <div class="col-md-6 mb-3">
            <label for="country" class="form-label">&nbsp;</label>
            <input type="submit" class="form-control btn btn-primary" value="Toevoegen" id="country" name="country">
        </div>
    </form>
    <?php if ($error) : ?>
        <div class="alert alert-danger" role="alert">
            Er is iets fout gegaan bij het verwijderen van het land.
        </div>
    <?php endif; ?>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">Land</th>
                <th scope="col">Verwijderen</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($countries as $country) : ?>
                <tr>
                    <td><?= $country->name ?></td>
                    <td>
                        <a href="admin_countries?id=<?= $country->id ?>" class="btn btn-danger">Verwijderen</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

