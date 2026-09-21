<?php
// includes/config.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Enable output buffering to prevent header redirect issues
if (ob_get_level() === 0) {
    ob_start();
}

// Pull the database connection into the configuration wrapper
require_once __DIR__ . '/db.php';

// Default site title (used if page doesn't set its own)
$default_title = "ITLC";
$title_separator = " | ";

// Contact Information
$phone_number = "+44 300 303 0266";
$email_address = "contact@yourdomain.com";
$address = "23621 15 Mile Rd #C104, Clinton MI, 48035, New York, USA";

// Social Media Links
$social_links = [
    'facebook' => 'https://www.facebook.com/themefisher',
    'twitter' => 'https://www.twitter.com/themefisher',
    'linkedin' => '#',
    'instagram' => '#',
    'dribbble' => 'https://dribbble.com/themefisher'
];

// Get current page name for active menu highlighting
$current_page = basename($_SERVER['PHP_SELF'], '.php');
