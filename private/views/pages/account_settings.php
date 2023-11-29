<?php
$error = false;
$errorpassword = false;
if (!isset($_SESSION['userId'])) {
    setcookie('redirect', 'account_settings', time() + (86400 * 30), "/");
    header('Location: login');
    exit();
}
$user = user::getUserById($_SESSION['userId']);
if (isset($_POST['password'])) {
    if (User::updateUserPassword($_POST['password'], $_POST['confirmPassword'], $_SESSION['userId'])) {
        header('Location: account_settings');
    } else {
        $errorpassword = true;
    }
} else if ($_POST) {
    if (User::updateUser($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['country'], $_SESSION['userId'])) {
        header('Location: account_settings');
    } else {
        $error = true;
    }

}
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Accountinstellingen</h2>
    <form method="post">
        <div class="mb-4">
            <?php if ($error) {
                echo '<div class="alert alert-danger" role="alert">Oeps er is iets misgegaan.</div>';
            } ?>
            <h4>Persoonlijke Informatie</h4>
            <div class="form-group">
                <label for="firstName">Voornaam</label>
                <input type="text" class="form-control" id="firstName" name="firstName" required
                       value="<?php echo $user->firstname ?>" placeholder="Voer uw voornaam in">
            </div>
            <div class="form-group">
                <label for="lastName">Achternaam</label>
                <input type="text" class="form-control" id="lastName" name="lastName" required
                       value="<?php echo $user->lastname ?>" placeholder="Voer uw achternaam in">
            </div>
            <div class="form-group">
                <label for="email">E-mailadres</label>
                <input type="email" class="form-control" id="email" name='email' required
                       value="<?php echo $user->email ?>" placeholder="Voer uw e-mailadres in">
            </div>
            <div class="form-group">
                <label for="country">Land</label>
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
            <br>
            <input type="submit" class="btn btn-primary btn-block" value="Wijzigingen Opslaan">
        </div>
    </form>
    <form method="post">
        <div class="mb-4">
            <?php if ($errorpassword) {
                echo '<div class="alert alert-danger" role="alert">Wachtwoorden zijn niet gelijk</div>';
            } ?>
            <h4>Wachtwoord</h4>
            <div class="form-group">
                <label for="password">Wachtwoord</label>
                <input type="password" class="form-control" id="password" required name="password"
                       placeholder="Voer uw wachtwoord in">
            </div>
            <div class="form-group">
                <label for="confirmPassword">Bevestig Wachtwoord</label>
                <input type="password" class="form-control" id="confirmPassword" required name="confirmPassword"
                       placeholder="Bevestig uw wachtwoord">
            </div>
        </div>

        <input type="submit" class="btn btn-primary btn-block" value="Wachtwoord wijzigen">
    </form>
</div>