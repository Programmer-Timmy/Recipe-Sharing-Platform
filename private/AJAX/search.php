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
    echo "<div class=\"container text-center mt-4\">
        <h1>Oeps, geen recept gevonden!</h1>
        <p>Het lijkt erop dat het recept dat je zoekt niet in onze collectie is. Geen zorgen, ontdek andere heerlijke
            recepten of voeg je eigen smakelijke creaties toe aan CookCook Connect!</p>
        <a href=\"recipes\" class=\"btn btn-primary mt-1 mb-4\">Ga terug</a>


        <!-- Display three random recipes as alternatives -->
        <div class=\"row mt-4\" style=\"border: none; background-color: rgba(182,182,182,0.16); border-radius: 5px;\">
            <div class=\"col-md-12 mt-3\">
                <h2>Ontdek andere heerlijke recepten</h2>
            </div>";
    $randomRecipes = Recipes::getRandomRecipes(); // Adjust the method based on your implementation

    foreach ($randomRecipes as $recipe) {
        echo "
    <div class=\"col-md-4 mt-4 mb-4 d-flex\">
                    <div class=\"card flex-fill\">
                        <a href=\"recipe?id=$recipe->id\" class=\"h-100 d-flex flex-column card-link\">
                            <img src=\"$recipe->img_url\" class=\"card-img-top\" alt=\"$recipe->title\">
                            <div class=\"card-body\">
                                <h5 class=\"card-title\">$recipe->title</h5>
                                <p class=\"card-text\">$recipe->description</p>
                            </div>
                            <div class=\"card-footer d-flex justify-content-between flex-wrap\">";
        $recipeCategories = Categories::getCategoriesByRecipes($recipe->id);
        foreach ($recipeCategories as $category) {
            echo "<span class=\"badge bg-primary m-1\">" . $category->name . "</span>";
        }
        echo "
                            </div>
                        </a>
                    </div>
                </div>
            ";
    }



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
