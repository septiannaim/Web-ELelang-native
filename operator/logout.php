<?php
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to login page with an alert message
header("Location: ../index.php?logout=success");
exit();
?>
