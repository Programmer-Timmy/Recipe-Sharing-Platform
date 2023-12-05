<?php
$recipe = Recipes::getRecipe($_GET['id']);

if (!$recipe) {
    echo "Recipe not found!";
    exit();
}
$commented = false;
$comments = comments::getCommentsByRecipeId($recipe->id);

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

$creator = User::getUserById($recipe->user_id);
$creatorImage = $creator ? $creator->img_url : '';


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

