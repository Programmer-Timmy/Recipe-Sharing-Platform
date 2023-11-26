<?php
$recipes = Recipes::getRandomRecipes();
$randomCategories = Categories::getRandomCategories();
$issetUser = isset($_SESSION['userId']) ? 'true' : 'false';

?>
<div class="container mt-5">
    <div class="row text-center">
        <div class="col-md-12">
            <h1>Welkom bij Receptenplatform</h1>
            <p>Ontdek en deel heerlijke recepten!</p>
            <a href="recipes" class="btn btn-primary">Verken Recepten</a>
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card text-center">
                <div class="card-body">
                    <h3 class="card-title">Uitgelichte Recepten</h3>
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
                                            
                                            <a href=\"recipe?id=$recipe->id\" class=\"card-link\">
                                                <img src=\"img/588A9371.jpg\" class=\"card-img-top\" alt=\"$recipe->title\">
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
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card text-center">
                <div class="card-body">
                    <h3 class="card-title">Verken Categorieën</h3>
                    <div class=" d-flex flex-wrap justify-content-evenly">
                        <?php
                        foreach ($randomCategories as $category) {
                            echo "<a href=\"category?id=$category->id\" class=\"btn btn-primary mr-2x w-25 m-3 p-3\">$category->name</a>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card text-center">
                <div class="card-body">
                    <h3 class="card-title">Persoonlijke Aanbevelingen</h3>
                    <!-- Persoonlijke aanbevelingen of gebruikersspecifieke inhoud komt hier -->
                </div>
            </div>
        </div>
    </div>
</div>
