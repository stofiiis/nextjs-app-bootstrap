<?php
// Global configuration for Vectoriana website

// Site settings
define('SITE_TITLE', 'Vectoriana s.r.o.');
define('SITE_DESCRIPTION', 'Geodetické práce, zeměměřičské činnosti a katastr nemovitostí');

// Contact information
define('COMPANY_NAME', 'Vectoriana s.r.o.');
define('COMPANY_ADDRESS', 'Hradešínská 2171/25');
define('COMPANY_CITY', '101 00 Praha 10');
define('COMPANY_PHONE', '+420 775 243 202');
define('COMPANY_EMAIL', 'info@vectoriana.com');
define('COMPANY_IC', '24793736');
define('COMPANY_DIC', 'CZ24793736');

// Plzen branch
define('PLZEN_ADDRESS', 'Rybalkova 41');
define('PLZEN_CITY', '101 00 Praha 10');
define('PLZEN_PHONE', '+420 775 243 202');
define('PLZEN_EMAIL', 'plzen@vectoriana.com');

// Error handling
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);

// Security settings
session_start();

// CSRF token generation
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Helper function for safe output
function safe_output($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Helper function for current page detection
function is_current_page($page) {
    $current_page = basename($_SERVER['PHP_SELF']);
    return $current_page === $page;
}
?>
