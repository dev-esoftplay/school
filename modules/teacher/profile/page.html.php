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
    <!-- Styles -->
    <style>
        /* General Styles */
        .container {
            padding: 15px;
        }

        .main-content {
            flex: 1;
            padding: 15px;
            transition: margin-left 0.3s ease;
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
            display: none;
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

        /* Overlay */
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

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            height: 100vh;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            z-index: 999;
            padding: 15px;
            display: flex;
            flex-direction: column;
        }

        .sidebar .menu-title {
            font-size: 1.2em !important;
            margin-top: 5px;
            margin-bottom: 10px;
            color: #006400;
            font-weight: bold;
            text-align: left;
        }

        .sidebar .menu-list {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .sidebar .menu-list ul {
            list-style: none;
            padding: 0;
        }

        .sidebar .menu-list ul li {
            margin: 10px 0;
            color: #333;
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
            text-decoration: none;
        }

        .sidebar .menu-list ul li a.active {
            background-color: #d3f4d1;
            color: #3E7B27;
            font-weight: bold;
            text-decoration: none;
        }

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

        .hidden {
            display: none;
        }

        @media (max-width: 768px) {
            body {
                display: block;
            }

            .hamburger {
                display: block;
            }

            .sidebar {
                position: fixed;
                right: -250px;
                transition: transform 0.3s ease;
            }

            .sidebar.active {
                transform: translateX(-250px);
            }

            .overlay.active {
                display: block;
            }
        }

        h2 {
            font-size: 16px;
            color: #333;
            margin-bottom: 20px;
        }

        /* Profile Content */
        .profile-section {
            width: 100%;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            position: relative;
        }

        /* Loading Indicator */
        .loading-indicator {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 16px;
            color: #3E7B27;
            font-weight: bold;
            display: block;
        }

        .profile-header img {
            border-radius: 50%;
            width: 80px;
            height: 80px;
            margin-right: 20px;
            display: none;
            /* Initially hidden until image loads */
        }

        .profile-header h1 {
            font-size: 1.8rem;
            font-weight: bold;
        }

        .profile-header p {
            font-size: 14px;
            color: #777;
        }

        .profile-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .profile-info .input-group {
            margin-bottom: 15px;
        }

        .profile-info .input-group label {
            font-size: 14px;
            color: #777;
        }

        .profile-info .input-group input {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ddd;
            font-size: 14px;
        }

        .profile-info .input-group input#num {
            width: 120%;
            /* Menambah lebar input NIP */
        }

        @media (min-width: 768px) {
            .sidebar {
                position: fixed;
                left: 0;
                transition: transform 0.3s ease;
            }

            .main-content {
                margin-left: 230px;
            }

            .profile-section {
                width: 100%;
            }

            .profile-info .input-group input#num {
                width: 100%;
            }
            .profile-info {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="overlay" id="overlay"></div>
    <button class="hamburger" id="hamburger">☰</button>
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
    <div class="main-content">
        <div class="container mt-4">
            <!-- Breadcrumb for Title -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="teacher/dashboard" class="breadcrumb-item-dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profil</li>
                </ol>
            </nav>
            <div class="profile-section">
                <div class="profile-header">
                    <!-- Loading Indicator -->
                    <div id="loading" class="loading-indicator">Loading...</div>

                    <!-- Profile Picture -->
                    <img src="<?php echo $imageurl; ?>" alt="Profile Picture" id="profile-picture">

                    <div>
                        <h1><?php echo htmlspecialchars($teacher['name'] ?? 'Tidak ditemukan'); ?></h1>
                        <p><?php echo htmlspecialchars($teacher['phone'] ?? 'Tidak ditemukan'); ?></p>
                    </div>
                </div>
                <form>
                    <div class="profile-info">
                        <div class="input-group">
                            <label for="name">Nama Depan</label>
                            <input type="text" id="name" name="name" value="<?php echo $firstName; ?>" disabled>
                        </div>
                        <div class="input-group">
                            <label for="fullname">Nama Belakang</label>
                            <input type="text" id="fullname" name="fullname" value="<?php echo $lastName; ?>" disabled>
                        </div>
                        <div class="input-group">
                            <label for="gender">Jenis Kelamin</label>
                            <input type="text" id="gender" name="phone" value="<?php echo htmlspecialchars($gender_text); ?>" disabled>
                        </div>
                        <div class="input-group">
                            <label for="birth">Tanggal Lahir</label>
                            <input type="text" id="birth" name="birth" value="<?php echo htmlspecialchars($formatted_date ?? 'Tidak ditemukan'); ?>" disabled>
                        </div>
                        <div class="input-group">
                            <label for="num">NIP</label>
                            <input type="number" id="num" name="num" value="<?php echo htmlspecialchars($teacher['nip'] ?? 'Tidak ditemukan'); ?>" disabled>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
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

        const profilePicture = document.getElementById('profile-picture');
        const loadingIndicator = document.getElementById('loading');

        profilePicture.onload = function() {
            loadingIndicator.style.display = 'none';
            profilePicture.style.display = 'block';
        };

        profilePicture.onerror = function() {
            loadingIndicator.style.display = 'none';
        };
    </script>
</body>

</html>