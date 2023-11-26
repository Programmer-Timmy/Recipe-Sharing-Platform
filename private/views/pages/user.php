<?php
if (isset($_GET['id'])) {
    $user = user::getUserById($_GET['id']);
    $userRecipes = Recipes::getRecipeByUser($_GET['id']);
    $issetUser = isset($_SESSION['userId'])?'true':'false';
} else {
    header('location: recipes');
}




?>
<div class="container  mt-4">
    <section id="profile" class="bg-light rounded p-4">
        <h2 class="mb-4 text-center">Profiel</h2>
        <div class="row">
            <div class="col-md-4 text-center">
                <img src="img/profilepic.jpg" alt="User Image" class="img-fluid rounded-circle mb-3" style="max-width: 150px; border: 4px solid #fff;">
                <h3 class="font-weight-bold"><?php echo $user->username?></h3>
            </div>

            <div class="col-md-8">
                <p class="lead"><?php echo $user->description ?></p>
            </div>
        </div>
    </section>
    <br>
    <section id="recipes" class="recipe-section">
        <h2 class="mb-4 text-center">Recepten</h2>

        <div class="row">
            <?php
            foreach($userRecipes as $userRecipe){
                $liked = "";
                if (isset($_SESSION['userId'])) {
                    $liked = user::getUserLikes($_SESSION['userId'], $userRecipe->id);
                }
                echo"
                <div class=\"col-md-4 mb-4 d-flex\">
                <div class=\"card flex-fill\">
                <button class=\"btn like-btn $liked\" id='likeButton_$userRecipe->id' onclick='like($userRecipe->id, $issetUser)'><i class=\"fas fa-heart\"></i></button>
                    <a href=\"recipe?id=$userRecipe->id\" class=\"card-link\">
                        <img src=\"img/588A9371.jpg\" class=\"card-img-top\" alt=\"$userRecipe->title\">
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">$userRecipe->title</h5>
                            <p class=\"card-text\">$userRecipe->description</p>
                        </div>
                        <div class=\"card-footer d-flex justify-content-between flex-wrap\">";
                $categories = Categories::getCategoriesByRecipes($userRecipe->id);
                foreach($categories as $category){
                    echo"<span class=\"badge bg-primary mr-2\">".$category->name."</span>";
                }
                echo"
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