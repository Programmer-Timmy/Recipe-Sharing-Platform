<?php
$recipe = Recipes::getRecipe($_GET['id']);
$commented = false;

$issetUser = isset($_SESSION['userId']) ? 'true' : 'false';
if (!isset($_SESSION['userId'])) {
    setcookie('redirect', "recipe?id=" . $_GET['id'], time() + 3600, '/');
} else {
    foreach ($comments as $comment) {
        if ($comment->user_id == $_SESSION['userId']) {
            $commented = true;
            $userComment = comments::getCommentsByUserAndProductId($recipe->id);

        }
    }

}




if ($_POST) {
    if ($commented) {
        comments::updateComment($userComment->id, $_POST['comment'], $_POST['rating'], $_SESSION['userId']);
        header("Location: recipe?id=" . $_GET['id']);
    } else {
        if (comments::createComment($_POST['comment'], $_POST['rating'], $_GET['id'], $_SESSION['userId'])) {
            header("Location: recipe?id=" . $_GET['id']);
        }
    }
}

if (isset($_GET['delete'])) {
    comments::deleteComment($_GET['delete']);
    header("Location: recipe?id=" . $_GET['id']);
}
if ($recipe) :
    $comments = comments::getCommentsByRecipeId($recipe->id);
    $creator = User::getUserById($recipe->user_id);
    $creatorImage = $creator ? $creator->img_url : '';

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
                <img style="width: 100%; object-fit: cover" src="<?php echo $recipe->img_url; ?>" class="img-fluid"
                     alt="<?php echo $recipe->title; ?>">
                <div class="mt-4">
                    <p><?php echo $recipe->description; ?></p>

                    <h4>Bereiding</h4>
                    <p><?php echo $recipe->instructions; ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Categorieën</h5>
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
                        <h5 class="card-title">Ingrediënten</h5>
                        <ul class="list-unstyled">
                            <?php
                            $ingredients = Ingredients::getIngredientsByRecipeId($recipe->id);
                            foreach ($ingredients as $ingredient) {
                                echo "<li class='mb-2'><i class=\"fas fa-angle-right\"></i> $ingredient->quantity $ingredient->name</li>";
                            }
                            ?>
                        </ul>
                        <hr class="my-4">
                        <h5 class="card-title">Gemaakt door:</h5>
                        <?php if ($creator): ?>
                            <a href="user?id=<?php echo $creator->id; ?>" class="text-decoration-none">
                                <div class="media mt-3 d-flex align-items-center flex-column" style="padding: 0 10px; border-radius: 8px;">
                                    <img src="<?php echo $creatorImage; ?>" class="rounded-circle mr-3" alt="Creator Image" width="64" height="64">
                                    <div class="media-body">
                                        <h6 class="mt-0" style="color: black"><?php echo $creator->username; ?></h6>

                                    </div>
                                </div>
                            </a>
                        <?php endif; ?>
                </div>
                </div>
                <div class="mt-4">
                    <button class="btn like-btn <?php if (isset($_SESSION['userId'])) {
                        echo user::getUserLikes($_SESSION['userId'], $recipe->id);
                    } ?>" id='likeButton_<?php echo $recipe->id; ?>'
                            onclick='like(<?php echo $recipe->id; ?>, <?php echo $issetUser; ?>)'>
                        <i class="fas fa-heart"></i> Like
                    </button>
                </div>
            </div>
        </div>
    </section>
    <h4 class="mt-4 mb-3">Commentaar</h4>

    <div class="row">
        <div class="col-md-8">
            <?php
            foreach ($comments as $comment):
                ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="media">
                            <img src="<?php echo $comment->img_url ?>" class="mr-3 rounded-circle" alt="User Avatar"
                                 width="64" height="64">
                            <div class="media-body">
                                <h5 class="mt-0"><?php echo $comment->username; ?></h5>
                            </div>
                        </div>
                        <p class="card-text"><?php echo $comment->comment; ?></p>
                        <div class="mb-2">
                            <strong>Beoordeling:</strong>
                            <?php
                            $stars = $comment->rating;
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $stars) {
                                    echo '<i class="fas fa-star text-warning"></i>';
                                } else {
                                    echo '<i class="far fa-star text-warning"></i>';
                                }
                            }
                            ?>
                        </div>
                        <small class="text-muted">Geplaats op <?php $date = new DateTime($comment->timestamp);
                            echo $date->format('d-m-Y H:i:s'); ?></small>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <?php

                    if ($commented) {
                        echo "<form method='post'>
                              <h4>Bewerk je commentaar</h4>
                                <div class=\"form-group\">
                                    <label for=\"comment\">Commentaar</label>
                                    <textarea class=\"form-control\" id=\"comment\" name='comment' rows=\"3\">$userComment->comment</textarea>
                                </div>
                                <div class=\"form-group\">
                                    <label for=\"rating\">Beoordeling</label>
                                    <select class=\"form-control\" id=\"rating\" name='rating'>";
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i == $userComment->rating) {
                                echo "<option value=\"$i\" selected>$i sterren</option>";
                            } else {
                                echo "<option value=\"$i\">$i sterren</option>";
                            }
                        }
                        echo "
                                    </select>
                                </div>
                                <BR>
                                <input type='submit' class='btn btn-primary' value='Bewerk commentaar'>
</form>";
                    } elseif (isset($_SESSION['userId'])) {
                        echo "
                            <form method='post'>
                            <H4>Laat commentaar achter</H4>
                                <div class=\"form-group\">
                                    <label for=\"comment\">Commentaar</label>
                                    <textarea class=\"form-control\" id=\"comment\" name='comment' rows=\"3\"></textarea>
                                </div>
                                <div class=\"form-group\">
                                    <label for=\"rating\">Beoordeling</label>
                                    <select class=\"form-control\" id=\"rating\" name='rating'>
                                        <option value=\"1\">1 ster</option>
                                        <option value=\"2\">2 sterren</option>
                                        <option value=\"3\">3 sterren</option>
                                        <option value=\"4\">4 sterren</option>
                                        <option value=\"5\">5 sterren</option>
                                    </select>
                                </div>
                                <BR>
                                <input type='submit' class='btn btn-primary' value='Plaats commentaar'>
                            ";
                    } else {
                        echo "<p>Je moet ingelogd zijn om commentaar te plaatsen</p>";
                        echo "<a href='login' class='btn btn-primary'>Login</a>";
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php else: ?>
    <div class="container text-center mt-4">
        <h1>Oeps, geen recept gevonden!</h1>
        <p>Het lijkt erop dat het recept dat je zoekt niet in onze collectie is. Geen zorgen, ontdek andere heerlijke
            recepten of voeg je eigen smakelijke creaties toe aan CookCook Connect!</p>
        <a href="recipes" class="btn btn-primary mt-1 mb-4">Ga terug</a>


        <!-- Display three random recipes as alternatives -->
        <div class="row mt-4" style="border: none; background-color: rgba(182,182,182,0.16); border-radius: 5px;">
            <div class="col-md-12 mt-3">
                <h2>Ontdek andere heerlijke recepten</h2>
            </div>
            <?php
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
            ?>
        </div>
    </div>


<?php endif; ?>
