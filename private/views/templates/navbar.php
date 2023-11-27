<?php
$requestedPage = $_SERVER['REQUEST_URI'];
if ($requestedPage == "/") {
    $requestedPage = 'home';
}


$position = strpos($requestedPage, "?");
$require = $requestedPage;
if ($position !== false) {
    $newString = substr($requestedPage, 0, $position);
    $require = $newString; // Output: "Hello "
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="home">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php if($require == '/home')echo"active"; ?>" aria-current="page" href="home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($require == '/recipes')echo"active"; ?>" aria-current="page" href="recipes">Recepten</a>
                </li>

            </ul>
            <ul class="navbar-nav me-2 mb-2 mb-lg-0">
                <input class="form-control me-2" type="search" id="search" name="search"
                       value="<?php if (isset($_COOKIE['search'])) {
                           echo $_COOKIE['search'];
                       } ?>" placeholder="Search" aria-label="Search">';


                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" data-bs-toggle="dropdown" aria-current="page" href="#"><i
                                style="font-size: 25px; padding-left: 10px" class="fa-regular fa-user"></i></a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="account">Profiel</a></li>
                        <li><a class="dropdown-item" href="account_settings">Instellingen</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="logout">Uitloggen</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="saved"><i style="font-size: 25px; padding-left: 10px" class="fa-regular fa-heart"></i></a>
                </li>
            </ul>

        </div>
    </div>
</nav>
