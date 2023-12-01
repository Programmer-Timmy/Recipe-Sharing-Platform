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
    'debug' => true,
    'maintenance' => false,
    'showPopup' => true,
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
    '404' => '404 - Oops pagina niet gevonden!',
];

// Disable errors if debug is set to false
if (!$site['debug']) {
    error_reporting(0);

}