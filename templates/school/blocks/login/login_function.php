<?php
// school/blocks/login/login_function.php

function school_login($username, $password) {
    // Example: Dummy user credentials (You can replace this with a database check)
    $valid_user = 'admin';
    $valid_pass = 'password123';

    // Check if the username and password are correct
    if ($username === $valid_user && $password === $valid_pass) {
        // Login successful
        $_SESSION['user'] = $username;
        return true;
    } else {
        // Login failed
        return false;
    }
}
