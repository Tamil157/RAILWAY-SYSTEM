<?php
session_start();
$_SESSION = array(); // Unset all session variables
session_destroy(); // Destroy the session
header('Location: index.html?logout=success'); // Redirect to index.html with a query parameter
exit();
?>
