<?php
if (!isset($_SESSION['userId'])) {
    header('location: login');
    exit();
} elseif ($_SESSION['admin'] != true) {
    header('location: home');
    exit();
}

$error = false;
$users = User::getAllUsers();

if (isset($_GET['delete'])) {
    $user = user::getUserById($_GET['delete']);
    // Assume you have a function to delete a user
    User::deleteByUserId($_GET['delete'], $user->img_url);
    header('location: admin_users');
}
if (isset($_GET['sendEmail'])) {
    $user = user::getUserById($_GET['sendEmail']);
    if ($user->verified == 0) {
        mail::sendEmailVerification($user->email, $user->firstname, $user->lastname, $user->token);
    }
    header('location: admin_users');
}
?>

<div class="container mt-5 custom-container">
    <div class="d-flex align-items-start justify-content-between">
        <h2 class="mb-4">Gebruikers</h2>
        <div>
            <a class="btn btn-primary" href="admin">Terug naar beheerdersdashboard</a>
            <a class="btn btn-primary" href="admin_addUser"><i class="fa-solid fa-plus"></i></a>
        </div>
    </div>

    <?php if ($error) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error ?>
        </div>
    <?php endif; ?>
    <div class="table-responsive">
        <table class="table">
            <thead class="table-dark">
            <tr>
                <th scope="col">Voornaam</th>
                <th scope="col">Achternaam</th>
                <th scope="col">Email</th>
                <th scope="col">Beschrijving</th>
                <th scope="col">Afbeelding</th>
                <th scope="col">Beheerder</th>
                <th scope="col">Gereegistreed op</th>
                <th scope="col">Land</th>
                <th scope="col">Geverifieerd</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>

            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?php echo $user->firstname ?></td>
                    <td><?php echo $user->lastname ?></td>
                    <td><?php echo $user->email ?></td>
                    <td>
                        <div style='max-width: 250px; max-height: 200px; overflow-y: auto;'><?php echo $user->description ?></div>
                    </td>
                    <td><a class="btn-primary btn" href="<?php echo $user->img_url ?>">Bekijken</a></td>
                    <td><?php echo $user->admin ? 'ja' : 'nee' ?></td>
                    <td><?php
                        $date = new DateTime($user->RegistrationDate);
                        echo $date->format('d-m-Y H:i:s'); ?></td>

                    <td><?php echo $user->name ?></td>
                    <td><?php echo $user->verified ? 'ja' : 'nee' ?></td>
                    <?php if ($_SESSION['userId'] != $user->id) : ?>
                        <td><a class="btn btn-primary" href="admin_editUser?id=<?php echo $user->id ?>"><i
                                        class="fa-solid fa-ellipsis"></i></a></td>
                        <?php if ($user->verified == 0) : ?>
                            <td><a class="btn btn-primary" href="admin_Users?sendEmail=<?= $user->id ?>"><i
                                            class="fa-solid fa-envelope"</a></td>
                        <?php else : ?>
                            <td></td>
                        <?php endif; ?>
                        <td><a class="btn btn-danger" href="admin_users?delete=<?php echo $user->id ?>"
                               onclick="return confirm('Weet je het zeker dat je deze gebruiker wilt verwijderen');"><i
                                        class="fa-solid fa-xmark"></i></a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>