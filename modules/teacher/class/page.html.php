<?php
if (!defined('_VALID_BBC'))
    exit('No direct script access allowed');

// Mengatur layout halaman
$sys->set_layout('teacher.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Input Nilai</title> -->
    <!-- Link to Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Styles -->
    <style>
        /* General Styles */
        .container {
            padding: 15px;
        }

        .breadcrumb {
            font-size: 16px;
            color: #666;
            margin-bottom: 10px;
            padding-left: 0px;
            background: none;
        }

        .breadcrumb-item-dashboard {
            color: #4B5320;
            /* Warna Hijau Army */
            font-weight: bold;
        }

        .breadcrumb-item-dashboard:hover {
            color: #3E4C23;
            /* Warna hijau lebih gelap saat hover */
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

        /* When sidebar is open, rotate the hamburger icon */
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
            /* Fixed typo by removing space */
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

        /* Default styles for anchor links in the sidebar */
        .sidebar .menu-list ul li a {
            text-decoration: none;
            color: black;
            padding: 10px;
            border-radius: 5px;
            display: block;
        }

        /* Hover effect for the links */
        .sidebar .menu-list ul li a:hover {
            background-color: #d3f4d1;
            color: #3E7B27;
            text-decoration: none;
        }

        /* Active link (current page) style */
        .sidebar .menu-list ul li a.active {
            background-color: #d3f4d1;
            color: #3E7B27;
            font-weight: bold;
            text-decoration: none;
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
            .col-md-4 {
            width: 100%;
            padding: 10px; /* Menambahkan padding horizontal untuk margin */
            box-sizing: border-box; /* Memastikan padding dan border tidak menambah lebar */
        }

        .custom-card {
            max-width: 100%;
            box-sizing: border-box; /* Memastikan padding dan border tidak menambah lebar */
        }
    
        }

        @media (min-width: 769px) {
            .sidebar {
                position: fixed;
                left: 0;
                transition: transform 0.3s ease;
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
            <div class="menu-separator">
                <div class="menu-1">
                    <ul>
                        <li><a href="teacher/dashboard" onclick="redirectAndClose(event, 'dashboard.php')"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                        <li><a href="teacher/class" onclick="redirectAndClose(event, 'class.php')"><i class="fas fa-chalkboard"></i> Kelas</a></li>
                        <li><a href="teacher/announcement" onclick="redirectAndClose(event, 'announcement.php')"><i class="fas fa-bullhorn"></i> Pengumuman</a></li>
                        <li><a href="teacher/score" onclick="redirectAndClose(event, 'score.php')"><i class="fas fa-pencil-alt"></i> Input Nilai</a></li>
                        <li><a href="teacher/profile" onclick="redirectAndClose(event, 'profile.php')"><i class="fas fa-user"></i> Profil</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="logout-link">
            <a href="teacher/logout" onclick="redirectAndClose(event, 'logout.php')"><i class="fas fa-sign-out-alt"></i> Keluar</a>
        </div>

        <div class="footer">
            <?php echo config('site', 'footer'); ?>
            <?php echo $sys->block_show('footer'); ?>
        </div>
    </div>

    <!-- Content Area -->
    <div class="container mt-4">
        <!-- Breadcrumb for Title -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="teacher/dashboard" class="breadcrumb-item-dashboard">Daftar Kelas</a></li>
            </ol>
        </nav>

        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background-color: #f8f9fa;
            }

            .custom-card {
                width: 100%;
                max-width: 370px;
                border: none;
                border-radius: 15px;
                padding: 20px;
                background: white;
                box-shadow: 0px 5px 15px rgba(44, 44, 44, 0.18);
                transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                position: relative;
            }

            .custom-card:hover {
                transform: translateY(-5px);
                box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
            }

            .profile-circle {
                width: 45px;
                height: 45px;
                background-color: rgb(170, 170, 170);
                color: white;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 600;
                font-size: 16px;
                position: absolute;
                right: 15px;
                top: 15px;
            }

            .profile-img {
                width: 45px;
                height: 45px;
                border-radius: 50%;
                object-fit: cover;
                border: 2px solid #fff;
                box-shadow: 0px 2px 5px rgba(255, 255, 255, 0.1);
            }

            .card-title {
                font-size: 20px;
                font-weight: 600;
                margin-bottom: 12px;
                color: #333;
            }

            .lihat-siswa-btn {
                margin-top: 15px;
                padding: 8px 15px;
                background-color: rgba(8, 86, 170, 0.94);
                color: white;
                border: none;
                border-radius: 8px;
                cursor: pointer;
                text-decoration: none;
                font-size: 14px;
                font-weight: 500;
                transition: background 0.3s ease-in-out;
            }

            .lihat-siswa-btn:hover {
                background-color: #0056b3;
            }

            .card-container {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                gap: 15px;
                margin-top: 20px;
            }

            .info-text {
                text-align: start;
                font-size: 18px;
                font-weight: 600;
                margin-top: 20px;
                color: #333;
                padding-left: 15px;
            }

            .wali-kelas {
                font-size: 14px;
                color: #555;
                display: flex;
                font-weight: 600;
                align-items: center;
                gap: 8px;
            }

            .wali-kelas i {
                color: rgb(0, 35, 100);
            }
        </style>
        <?php
        $no = 0; 
        $prevClassId = null;
        ?>
        <?php if (empty($teacherClass)) : ?>
            <div class="col-12 text-center">
                <p class="alert alert-warning">Data Kosong</p>
            </div>
        <?php else : ?>
            <?php foreach ($teacherClass as $class) : ?>
                <?php
                if ($class['id'] !== $prevClassId) {
                    $no++;
                }
                $prevClassId = $class['id']; 
                ?>

                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="custom-card">
                            <span class="card-title">
                                <?= htmlspecialchars($class['kelas']) ?><?= htmlspecialchars($class['label']) ?>
                            </span>
                            <div class="profile-circle">
                                <?= $no ?>
                            </div>
                            <div class="wali-kelas">
                                <i class="fas fa-user"></i> Wali Kelas: <?= htmlspecialchars($class['wali_kelas']) ?>
                            </div>
                            <a href="teacher/classdetail?class_id=<?= $class['id'] ?>" class="lihat-siswa-btn">Lihat Siswa</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>


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