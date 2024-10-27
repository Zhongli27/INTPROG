<?php
// error_reporting(0);
// session_start();
// if(!isset($_SESSION['username'])){
//     header('Location: login.php');
//     exit;
// }
error_reporting(0);
session_start();

// Check if the session exists, otherwise check for the cookie
if (!isset($_SESSION['username'])) {
    // If session is not set, check if the cookie is available
    if (isset($_COOKIE['username'])) {
        // If the cookie is set, log in the user by setting the session
        $_SESSION['username'] = $_COOKIE['username'];
    } else {
        // If neither session nor cookie is available, redirect to login page
        header('Location: login.php');
        exit;
    }
}

// If the user is authenticated, create the welcome message
$welcomeMessage = "Welcome, " . $_SESSION['username'] . "!";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Homepage</title>
</head>
</style>




