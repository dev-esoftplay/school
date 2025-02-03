<?php
if (!defined('_VALID_BBC')) exit('No direct script access allowed');

$sys->set_layout('teacher.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Profil</title>
    <!-- Link to Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 15px;
        }

        .breadcrumb {
            font-size: 16px;
            color: #666;
            margin-bottom: 10px;
            padding-left: 0;
            background: none;
        }

        .breadcrumb-item-dashboard {
            color: #4B5320;
            font-weight: bold;
        }

        .breadcrumb-item-dashboard:hover {
            color: #3E4C23;
        }

        /* Hamburger Button */
        .hamburger {
            font-size: 20px;
            background: none;
            border: none;
            cursor: pointer;
            position: fixed;
            top: 15px;
            right: 20px;
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        .hamburger.open {
            transform: rotate(90deg);
        }

        /* Sidebar Styles */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 998;
            display: none;
        }

        .overlay.active {
            display: block;
        }

        .sidebar {
            position: fixed;
            top: 0;
            right: -250px;
            width: 250px;
            height: 100%;
            background: white;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.2);
            z-index: 999;
            transition: right 0.3s ease;
            padding: 15px;
            display: flex;
            flex-direction: column;
        }

        .sidebar.active {
            right: 0;
        }

        .sidebar .menu-title {
            font-size: 1.2em;
            margin: 5px 0 10px;
            color: #006400;
            font-weight: bold;
        }

        .sidebar .menu-list ul {
            list-style: none;
            padding: 0;
        }

        .sidebar .menu-list ul li {
            margin: 10px 0;
        }

        .sidebar .menu-list ul li a {
            text-decoration: none;
            color: black;
            padding: 10px;
            border-radius: 5px;
            display: block;
        }

        .sidebar .menu-list ul li a:hover {
            background-color: #d3f4d1;
            color: #3E7B27;
        }

        .sidebar .menu-list ul li a.active {
            background-color: #d3f4d1;
            color: #3E7B27;
            font-weight: bold;
        }

        .sidebar .menu-list ul li a i {
            margin-right: 10px;
        }

        /* Footer */
    .footer {
        margin-top: 20px;
        font-size: 14px;
        color: #777;
        text-align: center;
    }

    .sidebar .logout-link a {
        color: red;
        background-color: transparent;
        padding: 12px 15px;
        border-radius: 5px;
        font-weight: bold;
        display: block;
    }

    .sidebar .logout-link a:hover {
        text-decoration: none;
        background-color: red;
        color: white;
    }

    .logout-link {
        margin-top: auto;
    }

        h2 {
            font-size: 16px;
            color: #333;
            margin-bottom: 20px;
        }

        .profile-info {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .profile-item {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }

        .profile-item:last-child {
            border-bottom: none;
        }

        .txt {
            color: #333;
            font-size: 14px;
        }

        .txt1 {
            color: #333;
            font-size: 13px;
            font-weight: bold;
        }

        @media (max-width: 480px) {
            .profile-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .txt {
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar & Hamburger Button -->
    <div class="overlay" id="overlay"></div>
    <button class="hamburger" id="hamburger">☰</button>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="menu-title">SDIT ERAPORT</div>
        <div class="menu-list">
            <ul>
                <li><a href="teacher/dashboard" onclick="redirectAndClose(event, 'dashboard.php')"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="teacher/class" onclick="redirectAndClose(event, 'class.php')"><i class="fas fa-chalkboard"></i> Kelas</a></li>
                <li><a href="teacher/announcement" onclick="redirectAndClose(event, 'announcement.php')"><i class="fas fa-bullhorn"></i> Pengumuman</a></li>
                <li><a href="teacher/score" onclick="redirectAndClose(event, 'score.php')"><i class="fas fa-pencil-alt"></i> Input Nilai</a></li>
                <li><a href="teacher/profile" onclick="redirectAndClose(event, 'profile.php')"><i class="fas fa-user"></i> Profil</a></li>
            </ul>
        </div>

        <div class="logout-link">
            <a href="teacher/logout" onclick="redirectAndClose(event, 'logout.php')"><i class="fas fa-sign-out-alt"></i> Keluar</a>
        </div>

        <div class="footer">
            <?php echo config('site', 'footer'); ?>
            <?php echo $sys->block_show('footer'); ?>
        </div>
    </div>

    <div class="container mt-4">
        <!-- Breadcrumb for Title -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="teacher/dashboard" class="breadcrumb-item-dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profil</li>
            </ol>
        </nav>

        <h2>Profil Guru</h2>
        <div class="profile-info">
            <div class="profile-item">
                <span class="txt1">Nama</span>
                <span class="txt">Budi Santoso</span>
            </div>
            <div class="profile-item">
                <span class="txt1">NIP</span>
                <span class="txt">123456789</span>
            </div>
            <div class="profile-item">
                <span class="txt1">No HP</span>
                <span class="txt">081234567890</span>
            </div>
            <div class="profile-item">
                <span class="txt1">Jabatan</span>
                <span class="txt">Guru Matematika</span>
            </div>
            <div class="profile-item">
                <span class="txt1">Gender</span>
                <span class="txt">Laki-laki</span>
            </div>
            <div class="profile-item">
                <span class="txt1">Tanggal Lahir</span>
                <span class="txt">1 Januari 1980</span>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        const hamburger = document.getElementById('hamburger');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        const activePage = window.location.pathname;
        const navLinks = document.querySelectorAll('.menu-list ul li a');

        navLinks.forEach(link => {
            if (link.href.includes(`${activePage}`)) {
                link.classList.add('active');
            }
        });

        hamburger.addEventListener('click', () => {
            if (sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                hamburger.textContent = '☰';
                hamburger.classList.remove('open');
            } else {
                sidebar.classList.add('active');
                overlay.classList.add('active');
                hamburger.textContent = '×';
                hamburger.classList.add('open');
            }
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            hamburger.textContent = '☰';
            hamburger.classList.remove('open');
        });
    </script>
</body>
</html>
