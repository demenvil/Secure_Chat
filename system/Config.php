<?php

if(DEBUG) {
    ini_set('display_errors', true);
    ini_set('html_errors', true);
    error_reporting(E_ALL);
}

define('WP_MEMORY_LIMIT', '100M');

// GENERAL
define('TITLE', 'MATH PROJECT #SWAG');

// DATABASE
define('DBHOST', 'localhost');
define('DBNAME', 'math');
define('DBUSER', 'math');
define('DBPASS', 'math');