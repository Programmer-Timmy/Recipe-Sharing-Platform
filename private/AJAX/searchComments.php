<?php
require_once('../private/config/settings.php');
// Include your database connection file

if (!isset($_SESSION['admin'])) {
    header('Location: home');
}
global $database;

$servername = $database['host'];
$username = $database['user'];
$password = $database['password'];
$dbname = $database['database'];

$issetUser = isset($_SESSION['userId']) ? 'true' : 'false';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$user = $_GET['userSelect'] ?? 0;
$recipe = $_GET['recipeSelect'] ?? 0;
if ($user != 0 && $recipe != 0) {
    // Filter by both user and recipe
    $comments = comments::getCommentsByUserAndRecipe($user, $recipe);
} elseif ($user != 0) {
    // Filter only by user
    $comments = comments::getCommentsByUserId($user);

} elseif ($recipe != 0) {
// Filter only by recipe
    $comments = comments::getCommentsByRecipeId($recipe);
}
?>

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col">Gebruiker</th>
            <th scope="col">Recept</th>
            <th scope="col">Commentaar</th>
            <th scope="col">Datum</th>
            <th scope="col">Acties</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($comments as $comment) : ?>
            <tr>
                <td><?= $comment->username ?></td>
                <td><?= $comment->title ?></td>
                <td><?= $comment->comment ?></td>
                <td><?= $comment->timestamp ?></td>
                <td>
                    <a href="admin_comments_delete?id=<?= $comment->id ?>" class="btn btn-danger">Verwijderen</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>