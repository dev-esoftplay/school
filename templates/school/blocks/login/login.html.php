<?php
// Start the session to handle error messages
session_start();

// Check if there is an error message to display
if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']); // Clear the error message after displaying
} else {
    $error_message = '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Include Bootstrap CSS or any other preferred CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="login-container">
                <h2 class="text-center">Login</h2>

                <?php if (!empty($error_message)) : ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error_message); ?></div>
                <?php endif; ?>

                <!-- Login form -->
                <form action="login_process.php" method="POST">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS (optional, for responsiveness and features) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
