<?php
if (!isset($_SESSION['userId'])) {
    $_COOKIE['redirect'] = "saved";
    header("Location: login");
}
$saved = Saved::getSavedByUser($_SESSION['userId']);

?>
<div class="container  mt-4">
    <section id="recipes" class="recipe-section">
        <!-- Recipe Section Content Goes Here -->
        <div class="row justify-content-end">
            <div class="col-md-6 mb-2">
                <h2 class="mb-4 text-center">Opgeslagen recepten</h2>
            </div>
            <div class="col-md-3 mb-4">
                <form>
                    <select class="form-select sort-by" aria-label="Default select example">
                        <option selected>Sorteren op</option>
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
            if(!$saved){
                echo "<h1 style='text-align: center;'>Geen opgeslagen recepten gevonden.</h1>";
            }
            foreach ($saved as $recipe) {
                echo "
                                        <div class=\"col-md-4 mb-4 d-flex\">
                                        <div class=\"card flex-fill\">
                                            <button class=\"btn like-btn liked\" id='likeButton_$recipe->recipes_id' onclick='like($recipe->recipes_id, \"true\")'><i class=\"fas fa-heart\"></i></button>
                                            
                                            <a href=\"recipe?id=$recipe->recipes_id\" class=\"card-link\">
                                                <img src=\"img/588A9371.jpg\" class=\"card-img-top\" alt=\"$recipe->title\">
                                                <div class=\"card-body\">
                                                    <h5 class=\"card-title\">$recipe->title</h5>
                                                    <p class=\"card-text\">$recipe->description</p>
                                                </div>
                                                <div class=\"card-footer d-flex justify-content-between flex-wrap\">";
                $categories = Categories::getCategoriesByRecipes($recipe->recipes_id);
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
    </section>
</div>
