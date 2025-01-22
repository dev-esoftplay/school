<?php
if (!defined('_VALID_BBC')) {
    exit('No direct script access allowed');
}

$sys->set_layout('teacher.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Layout for Samsung S8+</title>
    <style>
        /* Reset dan gaya dasar */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            color: #333;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            width: 90%; /* Sesuaikan dengan layar kecil */
            max-width: 360px; /* Batas untuk Samsung S8+ */
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            font-size: 1.8rem;
            color: #222;
            margin-bottom: 10px;
        }
        p {
            font-size: 1rem;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Teacher Layout</h1>
        <p>Layout ini dirancang untuk layar Samsung Galaxy S8+.</p>
    </div>
</body>
</html>
