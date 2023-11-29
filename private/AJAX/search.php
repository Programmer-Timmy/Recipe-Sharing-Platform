<?php
require_once('../private/config/settings.php');
// Include your database connection file
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

$search = $_GET['query'];
$sortby = $_GET['sortby'];
$categoryFilter = $_GET['category'];


switch ($sortby) {
    case 1:
        $sortby = "ORDER BY created_at DESC";
        break;
    case 2:
        $sortby = "ORDER BY created_at ASC";
        break;
    case 3:
        $sortby = "ORDER BY likes DESC";
        break;
    case 4:
        $sortby = "ORDER BY likes ASC";
        break;
    default:
        $sortby = "";
}
if ($categoryFilter == 0) {
    $results = Recipes::getRecipesWithSearch($search, $sortby);

} else {
    $results = Recipes::getRecipesWithSearchAndCategory($search, $categoryFilter, $sortby);

}

if ($results == null) {
    echo "<h1 style='text-align: center;'>Geen recepten gevonden.</h1>";
} else {
    foreach ($results as $recipe) {
        $liked = '';
        if (isset($_SESSION['userId'])) {
            $liked = user::getUserLikes($_SESSION['userId'], $recipe->id);
        }

        echo "
                <div class=\"col-md-4 mb-4 d-flex\">
                <div class=\"card flex-fill\">
                    <button class=\"btn like-btn $liked\" id='likeButton_$recipe->id' onclick='like($recipe->id, $issetUser)'><i class=\"fas fa-heart\"></i></button>
                    <a href=\"recipe?id=$recipe->id\" class=\"card-link h-100 d-flex flex-column\">
                        <img src=\"$recipe->img_url\" class=\"card-img-top\" alt=\"$recipe->title\">
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">$recipe->title</h5>
                            <p class=\"card-text\">$recipe->description</p>
                        </div>
                        <div class=\"card-footer d-flex justify-content-between flex-wrap\">";
        $categories = Categories::getCategoriesByRecipes($recipe->id);
        foreach ($categories as $category) {
            echo "<span class=\"badge bg-primary mr-2\">" . $category->name . "</span>";
        }
        echo "
                        </div>
                    </a>
                </div>
            </div>
                
                ";
    }
}
