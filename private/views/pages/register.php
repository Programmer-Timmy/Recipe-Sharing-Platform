<?php
$countries = country::getAllCountries();
if ($_POST) {
    if (User::register($_POST['username'], $_POST['firstName'], $_POST['lastName'], $_POST['email'], $_POST['password'], $_POST['country'])) {
        header("Location: login");
    };

}
?>

<section class="w-100 p-4 d-flex justify-content-center pb-4">


    <form method="post" style="width: 22rem;">
        <div class="form-outline mb-4">
            <input type="text" id="username" name="username" class="form-control">
            <label class="form-label" for="username">Gebruikersnaam</label>
        </div>

        <div class="form-outline mb-4">
            <input type="text" id="firstName" name="firstName" class="form-control">
            <label class="form-label" for="firstName">Voornaam</label>
        </div>

        <div class="form-outline mb-4">
            <input type="text" id="lastName" name="lastName" class="form-control">
            <label class="form-label" for="lastName">Achternaam</label>
        </div>


        <!-- Email input -->
        <div class="form-outline mb-4">
            <input type="email" id="form2Example1" name="email" class="form-control">
            <label class="form-label" for="form2Example1">Email Adres</label>
        </div>

        <!-- Password input -->
        <div class="form-outline mb-4">
            <input type="password" id="form2Example2" name="password" class="form-control">
            <label class="form-label" for="form2Example2">Wachtwoord</label>
        </div>

        <div class="form-outline mb-4">
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