<?php
/** TODO make a login page!! and change this!! */
$userRecipes = Recipes::getRecipeByUser('2')

?>
<div class="container  mt-4">
    <section id="profile" class="bg-light rounded p-4">
        <!-- Profile Section Content Goes Here -->
        <h2 class="mb-4 text-center">Profiel</h2>

        <div class="row">
            <!-- User Image (on the left) -->
            <div class="col-md-4 text-center">
                <img src="img/profilepic.jpg" alt="User Image" class="img-fluid rounded-circle mb-3" style="max-width: 150px; border: 4px solid #fff;">
                <h3 class="font-weight-bold">Tim van der Kloet</h3>
            </div>

            <!-- User Information (on the right) -->
            <div class="col-md-8">
                <!-- User Description -->
                <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
        </div>
    </section>
    <br>
    <!-- Your other HTML content -->

    <section id="recipes" class="recipe-section">
        <!-- Recipe Section Content Goes Here -->
        <h2 class="mb-4 text-center">Mijn Recepten</h2>

        <div class="row">
            <?php
            foreach($userRecipes as $userRecipe){
                echo"
                <div class=\"col-md-4 mb-4 d-flex\">
                <div class=\"card flex-fill\">
                    <button class=\"btn like-btn\"><i class=\"fas fa-heart\"></i></button>
                    <a href='editRecipe?id=$userRecipe->id' class=\"btn edit-btn\"><i class=\"fa-solid fa-pen-to-square\"></i></a>
                    <a href='account?delte=$userRecipe->id' class=\"btn delete-btn\"><i class=\"fa-solid fa-trash\"></i></a>
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