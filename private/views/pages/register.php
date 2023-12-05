<?php
$error = false;
$countries = country::getAllCountries();
if ($_POST) {
    $data = User::register($_POST['username'], $_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['password'], $_POST['country']);

    if (is_string($data)) {
        $error = $data;
    } else {
        header('Location: login');
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
            <input type="text" id="username" name="username" class="form-control">
        </div>

        <div class="form-outline mb-4">
            <label class="form-label" for="firstName">Voornaam:</label>
            <input type="text" id="firstName" name="firstName" class="form-control">
        </div>

        <div class="form-outline mb-4">
            <label class="form-label" for="lastName">Achternaam:</label>
            <input type="text" id="lastName" name="lastName" class="form-control">
        </div>


        <!-- Email input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="form2Example1">Email Adres:</label>
            <input type="email" id="form2Example1" name="email" class="form-control">
        </div>

        <!-- Password input -->
        <div class="form-outline mb-4">
            <label class="form-label" for="form2Example2">Wachtwoord:</label>
            <input type="password" id="form2Example2" name="password" class="form-control">
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