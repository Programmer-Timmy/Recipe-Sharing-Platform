<?php
// A function to generate a responsive title based on the URL
function getPageTitle() {
    global $titles;
    $url = $_SERVER['REQUEST_URI'];

    $pageTitle = ucfirst($titles['default']);

    // Find the corresponding title based on URL
    foreach ($titles as $urlPattern => $title) {
        if (strpos($url, $urlPattern) !== false) {
            $pageTitle = $title;
            break;
        }
    }
    return $pageTitle;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo getPageTitle(); ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="http://recipesharingplatform/css/styles.css">
</head>
<body>


