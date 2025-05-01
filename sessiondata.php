<?php
session_start(); // Start the session

if (!empty($_SESSION)) {
    echo "<h2>Session Data:</h2><br>";
    echo "<pre>";
    print_r($_SESSION);
    echo "</pre>";
} else {
    echo "No Session Data.";
}
?>
