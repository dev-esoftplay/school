<?php
// Initialize session to handle user state
session_start();

// Example for handling form submission and redirect after login
$error_message = ''; // Variable to hold any error messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve submitted username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sample username and password for demo (replace with real authentication)
    if ($username == 'admin' && $password == '123456') {
        // Set session data on successful login
        $_SESSION['username'] = $username;

        // Redirect to dashboard after successful login
        header('Location: http://localhost/school/dashboard');
        exit(); // Don't forget to call exit() after header redirect
    } else {
        // Set an error message if login fails
        $error_message = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo isset($sys) ? $sys->meta() : ''; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .login-container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .input-group {
            margin-bottom: 15px;
        }
        .input-group label {
            display: block;
            text-align: left;
            font-size: 14px;
            margin-bottom: 5px;
        }
        .input-group input {
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            font-size: 16px;
        }
        .btn {
            width: 100%;
            padding: 12px;
            background-color: #33FF57;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #28c745;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="" method="POST">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
        
        <?php if ($error_message): ?>
            <div class="error-message">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
