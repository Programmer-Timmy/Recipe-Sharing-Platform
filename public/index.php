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

// Include header
include __DIR__ . '/../private/Views/templates/header.php';

// Check if maintenance mode is active and the client's IP is allowed
if ($site['maintenance'] && !in_array($_SERVER['REMOTE_ADDR'], $allowedIPs)) {
    // Include the maintenance page
    include __DIR__ . '/../private/Views/pages/maintenance.php';
} else {
    // Include the common header
    include __DIR__ . '/../private/Views/templates/navbar.php';

    // Determine which page to display based on the request
    $requestedPage = $_SERVER['REQUEST_URI'];
    if ($requestedPage == "/") {
        $requestedPage = 'home';
    }

    // Include the specific page content
    $pageTemplate = __DIR__ . "/../private/Views/pages/$requestedPage.php";

    if (file_exists($pageTemplate)) {
        include $pageTemplate;
    } else {
        // Handle 404 or display a default page
        header('Location: /404');
    }

    // Include the common footer
    include __DIR__ . '/../private/Views/templates/footer.php';

    // Connect to the database
    global $database;
    database::connect($database['host'], $database['user'], $database['password'], $database['database']);
}

if ($site['showPopup'] && !isset($_SESSION['popupShown'])) {
    // Include your popup HTML or JavaScript code here
    include __DIR__ . '/../private/Views/popups/popup.php';

    // Set a session variable to remember that the popup has been shown
    $_SESSION['popupShown'] = true;
}
?>
