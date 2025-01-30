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
    <title>Daftar Guru dan Kelas</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff; /* Background langsung putih */
            color: #333;
            margin: 0;
            padding: 20px; /* Beri sedikit padding agar tidak terlalu menempel */
        }
        h1 {
            text-align: left;
            font-weight: bold;
            font-size: 16px;
            color: #3E4C23;
            margin-bottom: 15px;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        .teacher-item {
            margin-bottom: 15px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: #f9f9f9;
        }
        .teacher-item h2 {
            font-size: 1.2rem;
            margin-bottom: 5px;
            color: #333;
        }
        .teacher-item p {
            font-size: 0.9rem;
            color: #555;
            margin: 0;
        }
    </style>
</head>
<body>
    <h1>Daftar Guru dan Kelas</h1>
    <ul>
        <li class="teacher-item">
            <h2>Guru: Budi Santoso</h2>
            <p>Kelas: Matematika - 10A</p>
        </li>
        <li class="teacher-item">
            <h2>Guru: Ani Rahmawati</h2>
            <p>Kelas: Biologi - 11B</p>
        </li>
        <li class="teacher-item">
            <h2>Guru: Joko Widodo</h2>
            <p>Kelas: Fisika - 12C</p>
        </li>
    </ul>
</body>
</html>