<?php
$error = false;
$countries = country::getAllCountries();
if ($_POST) {
    if ($_POST['password'] != $_POST['password2']) {
        $error = "Wachtwoorden komen niet overeen";
    } else {
        $data = User::register($_POST['username'], $_POST['lastName'], $_POST['firstName'], $_POST['email'], $_POST['password'], $_POST['country']);
    }

    if (is_string($data)) {
        $error = $data;
    } else {
        header('Location: login?register=true');
        exit();
    }
}
?>

<section class="w-100 p-4 d-flex justify-content-center pb-4">


    <form method="post" style="width: 22rem;">
        <?php
        if ($error) {
            echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
        }
        ?>
        <div class="form-outline mb-4">
            <label class="form-label" for="username">Gebruikersnaam:</label>
            <input type="text" id="username" name="username" required class="form-control">
        </div>

        <div class="form-outline mb-4">
            <label class="form-label" for="firstName">Voornaam:</label>
            <input type="text" id="firstName" name="firstName" required class="form-control">
        </div>

        <div class="form-outline mb-4">
            <label class="form-label" for="lastName">Achternaam:</label>
            <input type="text" id="lastName" name="lastName" required class="form-control">
        </div>


        <!-- Email input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="form2Example1">Email Adres:</label>
            <input type="email" id="form2Example1" name="email" required class="form-control">
        </div>

        <!-- Password input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="form2Example2">Wachtwoord:</label>
            <input type="password" id="form2Example2" name="password" required class="form-control">
        </div>
        <div class="form-outline mb-4">
            <label class="form-label" for="form2Example3">Herhaal Wachtwoord:</label>
            <input type="password" id="form2Example3" name="password2" required class="form-control">
        </div>

        <div class="form-outline mb-4">
            <label class="form-label" for="username">Land:</label>

            <select class="form-select" name="country" aria-label="Default select example">
                <?php
                foreach ($countries as $country) {
                    echo "<option value='$country->id'>$country->name</option>";
                }

                ?>
            </select>
        </div>

        <!-- Submit button -->
        <input style="width: 100%" type="submit" class="btn btn-primary btn-block mb-4" value="Registreer">

    </form>
</section>