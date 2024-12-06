<?php
// Start the session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the session exists before trying to destroy it
if (isset($_SESSION)) {
    session_destroy(); // Destroy the session
    session_unset();   // Clear session variables
}

// Redirect or display a message after session destruction
header("Location: ../../vista/php/index.php");
exit;
?>