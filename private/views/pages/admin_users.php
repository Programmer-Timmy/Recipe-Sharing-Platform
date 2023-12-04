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

if ($_POST) {

    header('location: admin_editUsers');
}

if (isset($_GET['delete'])) {
    // Assume you have a function to delete a user
    User::deleteByUserId($_GET['delete']);
    header('location: admin_editUsers');
}
?>

<div class="container mt-5 custom-container">
    <h2 class="mb-4">Edit Users</h2>

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
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
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
                    <td><a class="btn-primary btn" href="<?php echo $user->img_url ?>">Afbeelding Bekijken</a></td>
                    <td><?php echo $user->admin ? 'ja' : 'nee' ?></td>
                    <td><?php
                        $date = new DateTime($user->RegistrationDate);
                        echo $date->format('d-m-Y H:i:s'); ?></td>

                    <td><?php echo $user->name ?></td>
                    <td><a class="btn btn-primary" href="admin_editUser?id=<?php echo $user->id ?>">Edit</a></td>
                    <td><a class="btn btn-danger" href="admin_User?delete=<?php echo $user->id ?>"
                           onclick="return confirm('Weet je het zeker dat je deze gebruiker wilt verwijderen');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>