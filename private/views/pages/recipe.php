<?php
$recipe = Recipes::getRecipe($_GET['id']);

if (!$recipe) {
    echo "Recipe not found!";
    exit();
}

$issetUser = isset($_SESSION['userId']) ? 'true' : 'false';
$creator = User::getUserById($recipe->user_id); // Assuming you have a creatorId in your Recipe class
$creatorImage = $creator ? $creator->img_url : ''; // Assuming imagePath is the path to the creator's image

?>

<div class="container mt-4">
    <section id="recipe" class="recipe-section">
        <!-- Single Recipe Content Goes Here -->
        <div class="row justify-content-center">
            <div class="col-md-8 mb-2">
                <h2 class="mb-4 text-center"><?php echo $recipe->title; ?></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <img src="img/588A9371.jpg" class="img-fluid" alt="<?php echo $recipe->title; ?>">
                <div class="mt-4">
                    <p><?php echo $recipe->description; ?></p>

                    <h4>Bereiding:</h4>
                    <p><?php echo $recipe->instructions; ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Categories</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <?php
                                    $categories = Categories::getCategoriesByRecipes($recipe->id);
                                    $halfCount = ceil(count($categories) / 2);
                                    $firstHalf = array_slice($categories, 0, $halfCount);
                                    foreach ($firstHalf as $category) {
                                        echo "<li class=\"mb-2\"><i class=\"fas fa-angle-right\"></i> $category->name</li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <?php
                                    $secondHalf = array_slice($categories, $halfCount);
                                    foreach ($secondHalf as $category) {
                                        echo "<li class=\"mb-2\"><i class=\"fas fa-angle-right\"></i> $category->name</li>";
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <hr class="my-4">
                        <h5 class="card-title">Ingredients</h5>
                        <ul class="list-unstyled">
                            <?php
                            $ingredients = Ingredients::getIngredientsByRecipeId($recipe->id);
                            foreach ($ingredients as $ingredient) {
                                echo "<li class='mb-2'><i class=\"fas fa-angle-right\"></i> $ingredient->quantity $ingredient->name</li>";
                            }
                            ?>
                        </ul>
                        <hr class="my-4">
                        <h5 class="card-title">Created by</h5>
                        <?php if ($creator): ?>
                            <a href="user?id=<?php echo $creator->id; ?>" class="text-decoration-none">
                                <div class="media mt-3 d-flex align-items-center flex-column" style="padding: 0 10px; border-radius: 8px;">
                                    <img src="<?php echo $creatorImage; ?>" class="rounded-circle mr-3" alt="Creator Image" width="64" height="64">
                                    <div class="media-body">
                                        <h6 class="mt-0" style="color: black"><?php echo $creator->username; ?></h6>

                                    </div>
                                </div>
                            </a>
                        <?php else: ?>
                            <p>Unknown User</p>
                        <?php endif; ?>



                </div>
                </div>
                <div class="mt-4">
                    <button class="btn like-btn <?php echo user::getUserLikes($_SESSION['userId'], $recipe->id); ?>" id='likeButton_<?php echo $recipe->id; ?>' onclick='like(<?php echo $recipe->id; ?>, <?php echo $issetUser; ?>)'>
                        <i class="fas fa-heart"></i> Like
                    </button>
                </div>
            </div>
        </div>
    </section>
</div>

