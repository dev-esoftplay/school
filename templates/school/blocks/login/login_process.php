<?php
// login_process.php

// Include the login function
include 'school/blocks/login/login_function.php';

// Start the session for login status
session_start();

// Check if the login form is submitted
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Call the login function
    if (school_login($username, $password)) {
        // Redirect to the dashboard or main page after successful login
        header("Location: dashboard.php");
        exit();
    } else {
        // Login failed, redirect back to login page with an error message
        $_SESSION['error_message'] = "Invalid username or password.";
        header("Location: login.html.php");
        exit();
    }
}
