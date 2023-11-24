<?php
// Include necessary files
require_once __DIR__ . '/../private/autoload.php';
require_once __DIR__ . '/../private/config/settings.php';

// Start a session
session_start();

// Global variables
global $site;
global $database;
global $allowedIPs;

// Determine which page to display based on the request
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

if ($require !== '/search' && $require !== '/saveRecipe'){
// Include header
    include __DIR__ . '/../private/Views/templates/header.php';

// Check if maintenance mode is active and the client's IP is allowed
    if ($site['maintenance'] && !in_array($_SERVER['REMOTE_ADDR'], $allowedIPs)) {
        // Include the maintenance page
        include __DIR__ . '/../private/Views/pages/maintenance.php';
    } else {
        // Connect to the database
        global $database;

        $servername = $database['host'];
        $username = $database['user'];
        $password = $database['password'];
        $dbname = $database['database'];
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

        // Include the common header
        include __DIR__ . '/../private/Views/templates/navbar.php';

        // Include the specific page content
        $pageTemplate = __DIR__ . "/../private/Views/pages/$require.php";

        if (file_exists($pageTemplate)) {
            include $pageTemplate;
        } else {
            // Handle 404 or display a default page
            header('Location: /404');
        }

        // Include the common footer
        include __DIR__ . '/../private/Views/templates/footer.php';

    }

    if ($site['showPopup'] && !isset($_SESSION['popupShown'])) {
        // Include your popup HTML or JavaScript code here
        include __DIR__ . '/../private/Views/popups/popup.php';

        // Set a session variable to remember that the popup has been shown
        $_SESSION['popupShown'] = true;
    }
}else{
    require_once __DIR__ . "/../private/AJAX/$require.php";
}
?>

