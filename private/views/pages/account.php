<?php
$error = false;
if(!isset($_SESSION['userId'])){
    setcookie('redirect', 'account', time() + (86400 * 30), "/");

    header('Location: login');
} else {
    $user = user::getUserById($_SESSION['userId']);
    $userRecipes = Recipes::getRecipeByUser($_SESSION['userId']);
}

if (isset($_GET['delete'])) {
    if (User::deleteByUserId($_GET['delete'], $user->img_url)) {
        header('Location: logout');
    } else {
        $error = true;
    }
}
if ($_POST) {
    if (User::updateUserPage($_POST['username'], $_POST['bio'], $_FILES['avatar'], $_SESSION['userId'])) {
        header('Location: account');
    } else {
        $error = true;
    }
}
?>
<div class="container  mt-4">
    <?php if ($error) {
        echo '<div class="alert alert-danger" role="alert">Oeps er is iets misgegaan.</div>';
    } ?>
    <section id="profile" class="bg-light rounded p-4">
        <div class="row justify-content-end">
            <div class="col-md-6 mb-2">
                <h2 class="mb-4 text-center">Profiel</h2>
            </div>
            <div class="col-md-3 d-flex responsive justify-content-end align-items-start">
                <button id="editProfileBtn" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#editProfileModal">Edit Profile
                </button>
                <a href="account?delete=<?php echo $_SESSION['userId'] ?>" class="btn btn-danger ms-2"><i
                            class="fa-solid fa-xmark"></i></a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 text-center">
                <img src="<?php echo $user->img_url ?>" alt="User Image" class="img-fluid rounded-circle mb-3"
                     style="max-width: 150px; border: 4px solid #fff;">
                <h3 class="font-weight-bold"><?php echo ucfirst($user->username) ?></h3>
            </div>

            <div class="col-md-8">
                <p class="lead"><?php echo $user->description ?></p>
            </div>
        </div>
    </section>
    <br>
    <section id="recipes" class="recipe-section">
        <div class="row justify-content-end">
            <div class="col-md-6 mb-2">
                <h2 class="mb-4 text-center">Mijn recepten</h2>
            </div>
            <div class="col-md-3 d-flex responsive justify-content-end align-items-start">
                <a href="addRecipe" class="btn btn-primary">Voeg een recept toe</a>
            </div>
        </div>
        <div class="row">
            <?php
            if ($userRecipes) {
                foreach ($userRecipes as $userRecipe) {
                    echo "
                <div class=\"col-md-4 mb-4 d-flex\">
                <div class=\"card flex-fill\">
                    <a href='editRecipe?id=$userRecipe->id' class=\"btn btn-primary  edit-btn\"><i class=\"fa-solid fa-ellipsis\"></i></a>
                    <a href='account?delete=$userRecipe->id' class=\"btn btn-danger delete-btn\"><i class=\"fa-solid fa-xmark\"></i></a>
                    <a href=\"recipe?id=$userRecipe->id\" class=\"card-link h-100 d-flex flex-column\">
                        <img src=\"$userRecipe->img_url\" class=\"card-img-top\" alt=\"$userRecipe->title\">
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">$userRecipe->title</h5>
                            <p class=\"card-text\">$userRecipe->description</p>
                        </div>
                        <div class=\"card-footer d-flex justify-content-between flex-wrap\">";
                    $categories = Categories::getCategoriesByRecipes($userRecipe->id);
                    foreach ($categories as $category) {
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
                echo "<h3 class='text-center'>Je hebt nog geen recepten toegevoegd</h3>";
                echo "<div class='d-flex justify-content-center'><a href='addRecipe' class='btn btn-primary'>Voeg een recept toe</a></div>";
            }
            ?>
        </div>
    </section>
    <?php include_once __dir__ . '/../Popups/editprofile.php' ?>
</div>