<?php
/**
 * Database Settings
 */
$database = [
    'host' => 'localhost',
    'user' => 'root',
    'password' => '',
    'database' => 'recipe_sharing_platform',
];

/**
 * Site Settings
 */
$site = [
    'siteName' => 'CookCook Connect',
    'debug' => false,
    'maintenance' => false,
    'showPopup' => false,
    'popupTitle' => 'Welkom op de website!',
    'popupMessage' => 'Deze website is nog in ontwikkeling, het kan dus zijn dat er nog bugs in zitten.',
    'popupButtons' => [
//        [
//            'label' => 'Change button',
//            'action' => ''
//        ],
        // Add more buttons as needed
    ]

];

/**
 * Allowed IPs That can bypass the maintenance
 */
$allowedIPs = ['::0'];

/**
 * Page Title Settings
 */
$url = $_SERVER['REQUEST_URI'];
$url = explode('?', $url)[0];

// If the URL is the root path, set it to '/home'
if ($url == '/') {
    $url = '/home';
}

$titles = [
    'default' => substr($url, 1) . ' - ' . $site['siteName'],
    'maintenance' => 'Under Maintenance - ' . $site['siteName'],
    'home' => 'Home pagina - ' . $site['siteName'],
    'about' => 'About Us - ' . $site['siteName'],
    'contact' => 'Contact Us - ' . $site['siteName'],
    'account_settings' => 'Account instellingen - ' . $site['siteName'],
    'recipes' => 'Recepten - ' . $site['siteName'],
    'account' => 'Profiel - ' . $site['siteName'],
    'saved' => 'Opgeslagen - ' . $site['siteName'],
    'admin' => 'Beheerdersdashboard - ' . $site['siteName'],
    'admin_users' => 'Beheer gebruikers - ' . $site['siteName'],
    'admin_recipes' => 'Beheer recepten - ' . $site['siteName'],
    'admin_categories' => 'Beheer categorieën - ' . $site['siteName'],
    'admin_comments' => 'Beheer commentaar - ' . $site['siteName'],
    'admin_countries' => 'Beheer landen - ' . $site['siteName'],
    'login' => 'Inloggen - ' . $site['siteName'],
    'register' => 'Registreren - ' . $site['siteName'],
    'recipe' => 'Recept - ' . $site['siteName'],
    '404' => '404 - Oops pagina niet gevonden!'
];

// Disable errors if debug is set to false
if (!$site['debug']) {
    error_reporting(0);

}