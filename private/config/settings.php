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
    'siteName' => 'Recepten delen aplicatie',
    'debug' => true,
    'maintenance' => false,
    'showPopup' => false,
    'popupTitle' => 'Note',
    'popupMessage' => 'This is a popup you can change it in the settings!',
    'popupButtons' => [
        [
            'label' => 'Change button',
            'action' => ''
        ],
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

// If the URL is the root path, set it to '/home'
if ($url == '/') {
    $url = '/home';
}

$titles = [
    'default' => substr($url, 1) . ' - ' . $site['siteName'],
    'maintenance' => 'Under Maintenance - ' . $site['siteName'],
    'home' => 'Home Page - ' . $site['siteName'],
    'about' => 'About Us - ' . $site['siteName'],
    'contact' => 'Contact Us - ' . $site['siteName'],
    '404' => '404 - Oops page not found!',
];

// Disable errors if debug is set to false
if (!$site['debug']) {
    error_reporting(0);

}