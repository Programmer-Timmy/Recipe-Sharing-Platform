<?php
if (!isset($_SESSION['userId'])) {
    header('location: login');
    exit();
} elseif ($_SESSION['admin'] != true) {
    header('location: home');
    exit();
}

$error = false;

$user = User::getUserById($_GET['id']);

if ($_POST) {
    if (isset($_POST['admin'])) {
        $admin = 1;
    } else {
        $admin = 0;
    }

    User::updateUserAdmin($_GET['id'], $_POST['username'], $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['description'], $admin, $_FILES['image'], $_POST['country'], $user->img_url);
    header('location: admin_users');
}
?>

<div class="container mt-5 custom-container">
    <div class="d-flex align-items-start justify-content-between">
        <h2 class="mb-4">Bewerk gebruiker <?php echo "$user->firstname $user->lastname" ?></h2>
        <a class="btn btn-primary" href="admin_users">Terug naar gebruikers</a>
    </div>

    <?php if ($error) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error ?>
        </div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">

        <div class="form-group">
            <label for="firstname">Voornaam:</label>
            <input type="text" maxlength="40" class="form-control" id="firstname" name="firstname"
                   value="<?php echo $user->firstname ?>">
        </div>
        <div class="form-group">
            <label for="lastname">Achternaam:</label>
            <input type="text" maxlength="40" class="form-control" id="lastname" required name="lastname"
                   value="<?php echo $user->lastname ?>">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" maxlength="100" class="form-control" id="email" required name="email"
                   value="<?php echo $user->email ?>">
        </div>
        <div class="form-group">
            <label for="firstname">Gebruikersnaam:</label>
            <input type="text" maxlength="40" class="form-control" id="firstname" required name="username"
                   value="<?php echo $user->username ?>">
        </div>
        <div class="form-group">
            <label for="description">Beschrijving:</label>
            <textarea class="form-control" id="description"
                      name="description"><?php echo $user->description ?></textarea>
        </div>
        <div class="form-group">
            <label for="country">Land:</label>
            <select class="form-select" id="country" required name="country" aria-label="Selecteer uw land">
                <?php
                $countries = country::getAllCountries();
                foreach ($countries as $country) {
                    $selected = "";
                    if ($country->id == $user->country_id) {
                        $selected = "selected";
                    }
                    echo "<option $selected value='$country->id'>$country->name</option>";

                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="image" class="form-label">Afbeelding</label>
            <input type="file" id="image" name="image" accept="image/png, image/jpeg, image/gif" class="form-control">
        </div>
        <div class="form-group">
            <input class="form-check-input" type="checkbox" id="admin" name="admin"
                   value="1" <?php echo $user->admin ? 'checked' : '' ?>>
            <label class="form-check-label" for="admin">Beheerder:</label>
        </div>

        <button type="submit" class="btn btn-primary">Opslaan</button>
    </form>
</div>

