<?php
$issetUser = isset($_SESSION['userId']) ? 'true' : 'false';
$categories = Categories::getAllCategories(); // Assuming you have a method to get all categories

if (isset($_GET['category'])) {
    $recipes = Recipes::getRecipesByCategory($_GET['category']);
} else {
    $recipes = Recipes::getRecipes();
}
?>

<div class="container mt-4">
    <section id="recipes" class="recipe-section">
        <!-- Recipe Section Content Goes Here -->
        <h2 class="mb-4 text-center">Recepten</h2>

        <div class="row justify-content-end">
            <div class="col-md-3 mb-4">
                <form>
                    <select class="form-select" id="categoryFilter" aria-label="Default select example">
                        <option value="0" selected>Filter op categorie</option>
                        <?php foreach ($categories as $category) : ?>
                        <?php
                        $selected = "";
                        if (isset($_GET['category']) && $_GET['category'] == $category->id) {
                            $selected = "selected";
                        }
                        ?>

                        <option value="<?php echo $category->id . '" ' . $selected; ?>><?php echo $category->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </form>
            </div>
            <div class="col-md-6 mb-2">
            </div>
            <div class="col-md-3 mb-4">
                <form>
                    <select class="form-select sort-by" id="sortby" aria-label="Default select example">
                        <option value="0" selected>Sorteren op</option>
                        <option value="1">Nieuwste</option>
                        <option value="2">Oudste</option>
                        <option value="3">Meeste likes</option>
                        <option value="4">Minste likes</option>
                    </select>
                </form>
            </div>

        </div>
        <div class="row" id="search-results">
            <?php
            foreach ($recipes as $recipe) {

                    $liked = "";
                    if (isset($_SESSION['userId'])) {
                        $liked = user::getUserLikes($_SESSION['userId'], $recipe->id);
                    }
                    echo "
                        <div class=\"col-md-4 mb-4 d-flex\">
                            <div class=\"card flex-fill\">
                                <button class=\"btn like-btn $liked\" id='likeButton_$recipe->id' onclick='like($recipe->id, $issetUser)'><i class=\"fas fa-heart\"></i></button>
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
            ?>
        </div>
    </section>
</div>
