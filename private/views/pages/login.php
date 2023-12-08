<?php
$wrong = false;
if (!isset($_COOKIE['redirect'])) {
    setcookie('redirect', 'account', time() + 3600, '/');
}
    if($_POST){
        if(user::login($_POST['email'], $_POST['password'])){
            header("Location: ".$_COOKIE['redirect']);
        }else{
            $wrong = true;
        }

    }
?>

<section class="w-100 p-4 d-flex justify-content-center pb-4">


    <form method="post" style="width: 22rem;">
        <?php
        if ($wrong) {

            echo '<div class="alert alert-danger text-center" role="alert">
        Wachtwoord of email is onjuist!
    </div>';
        }
        ?>
        <!-- Email input -->
        <div class="form-outline mb-4">
            <input type="email" id="form2Example1" name="email" class="form-control">
            <label class="form-label"  for="form2Example1">Email Adres</label>
        </div>

        <!-- Password input -->
        <div class="form-outline mb-4">
            <input type="password" id="form2Example2" name="password" class="form-control">
            <label class="form-label" for="form2Example2">Wachtwoord</label>
        </div>

        <!-- 2 column grid layout for inline styling -->
        <div class="row mb-4">
            <div class="col d-flex justify-content-center">
                <!-- Checkbox -->
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked="">
                    <label class="form-check-label" for="form2Example31"> Remember me </label>
                </div>
            </div>

            <div class="col">
                <!-- Simple link -->
                <a href="#!">Wachtwoord vergeten?</a>
            </div>
        </div>

        <!-- Submit button -->
        <input style="width: 100%" type="submit" class="btn btn-primary btn-block mb-4" value="Inloggen">

        <!-- Register buttons -->
        <div class="text-center">
            <p>Nog geen lid? <a href="register">registreer</a></p>
        </div>
    </form>
</section>