<?php
if (!empty($_GET['token']) && $_GET['token'] !== '') {

    if ($data = User::verifyUser($_GET['token']) === true) {
        $error = false;
    } else {
        $error = true;
    }
} else {
    header('Location: home');
}
?>

<div class="container text-center">
    <h1 class="mt-5">Email Verificatie</h1>

    <?php
    // Controleer of er een fout is
    if (isset($error) && $error) {
        echo '<p class="error-message">Verificatie mislukt. Probeer het opnieuw.</p>';
        echo '<a href="home" class="btn btn-primary">Home</a>';
    } else {
        echo '<p class="success-message">Verificatie gelukt. U kunt nu inloggen.</p>';
        echo '<a href="login" class="btn btn-primary">Login</a>';
    }
    ?>
</div>