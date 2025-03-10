<?php

use Google\Api\ResourceDescriptor\Style;

if (!defined('_VALID_BBC'))
    exit('No direct script access allowed');

// Set the layout for the teacher dashboard
$sys->set_layout('student.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <style>
        /* General Styles */
        body {
            margin: 0;
            padding: 0;
            margin: 0 auto;
            background-color: #f4f4f4;
            overflow-x: hidden;
            display: flex;
        }

        .main-content {
            flex: 1;
            padding: 15px;
            transition: margin-left 0.3s ease;
        }

        .dashboard {
            padding: 15px;
        }

        /* Breadcrumb Style */
        .breadcrumb {
            font-size: 16px;
            color: #666;
            margin-bottom: 10px;
            padding-left: 0px;
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
            background: linear-gradient(135deg, #3E7B27, #66BB6A);
            /* Gradient background */
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
            z-index: 999;
            padding: 20px;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            color: white;
            /* Text color for better contrast */
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .sidebar .menu-title {
            font-size: 1.5em;
            /* Increased font size */
            margin-bottom: 20px;
            font-weight: bold;
            text-align: left;
            color: white;
            /* White text for contrast */
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
            margin: 15px 0;
        }

        .sidebar .menu-list ul li a {
            text-decoration: none;
            color: white;
            padding: 12px 15px;
            border-radius: 8px;
            display: block;
            transition: background-color 0.3s ease;
        }

        .sidebar .menu-list ul li a:hover,
        .sidebar .menu-list ul li a.active {
            background-color: rgba(220, 245, 203, 0.5);
            color: white;
        }


        .sidebar .logout-link a {
            background-color: #DC143C;
            color: white;
            padding: 12px 15px;
            border-radius: 8px;
            font-weight: bold;
            display: block;
            transition: background-color 0.3s ease;
        }

        .sidebar .logout-link a:hover {
            background-color: #B80F0A;
        }

        .logout-link {
            margin-top: auto;
        }

        /* Footer */
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #E0F2E7;
            text-align: center;
        }

        h2 {
            font-size: 16px;
            color: #333;
            margin-bottom: 20px;
        }

        .dropdown {
            background: white;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
            overflow: hidden;
        }

        .dropdown-header {
            background: #f9f9f9;
            color: black;
            padding: 10px;
            font-size: 16px;
            font-weight: normal;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .dropdown-content {
            display: none;
            padding: 10px;
            background: #f9f9f9;
        }

        /* Profile Content */
        .profile-section {
            width: 70%;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-header img {
            border-radius: 50%;
            width: 80px;
            height: 80px;
            margin-right: 20px;
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

        /* Responsive Styles */
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

            .container {
                flex-direction: column;
            }

            .profile-section {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="overlay"></div>
    <div class="overlay" id="overlay"></div>
    <button class="hamburger" id="hamburger">☰</button>
    <div class="sidebar" id="sidebar">
        <div class="menu-title">SDIT ERAPORT</div>
        <div class="menu-list">
            <div class="menu-separator">
                <div class="menu-1">
                    <ul>
                        <li><a href="student/dashboard" onclick="redirectAndClose(event, 'dashboard.php')"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                        <li><a href="student/score" onclick="redirectAndClose(event, 'score.php')"><i class="fas fa-book"></i> Raport</a></li>
                        <li><a href="student/profile" onclick="redirectAndClose(event, 'profile.php')"><i class="fas fa-user"></i> Profil</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="logout-link">
            <a href="student/logout" onclick="redirectAndClose(event, 'logout.php')"><i class="fas fa-sign-out-alt"></i> Keluar</a>
        </div>
        <div class="footer">
            <?php echo config('site', 'footer'); ?>
            <?php echo $sys->block_show('footer'); ?>
        </div>
    </div>

    <div class="main-content">
        <div class="dashboard">
            <div class="breadcrumb">Student Profile</div>
            <!-- Profile Section -->
            <div class="profile-section">
                <div class="profile-header">
                    <img src="<?php echo $imageURL; ?>" alt="Profile Picture">
                    <div>
                        <h1><?php echo htmlspecialchars($profileData['name'] ?? 'Tidak ditemukan'); ?></h1>
                        <p><?php echo htmlspecialchars($profileData['address'] ?? 'Tidak ditemukan'); ?></p>
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
                            <label for="email">NIS</label>
                            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($profileData['nis'] ?? 'Tidak ditemukan'); ?>" disabled>
                        </div>
                        <div class="input-group">
                            <label for="gender">Jenis Kelamin</label>
                            <input type="text" id="gender" name="phone" value="<?php echo htmlspecialchars($gender_text); ?>" disabled>
                        </div>
                        <div class="input-group">
                            <label for="location">Alamat</label>
                            <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($profileData['address'] ?? 'Tidak ditemukan'); ?>" disabled>
                        </div>
                        <div class="input-group">
                            <label for="birth">Tanggal Lahir</label>
                            <input type="text" id="birth" name="birth" value="<?php echo htmlspecialchars($formatted_date ?? 'Tidak ditemukan'); ?>" disabled>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <h2>Profil Orang Tua</h2>
        <div class="dropdown">
            <div class="dropdown-header" onclick="toggleDropdown('father-details')">
                Data Ayah <i class="fas fa-chevron-down"></i>
            </div>
            <div class="dropdown-content" id="father-details">
                <div class="profile-section">
                    <div class="profile-header">
                        <img src="<?php echo $imageURL; ?>" alt="Profile Picture">
                        <div>
                            <h1><?php echo htmlspecialchars($parentfatherData['name'] ?? 'Tidak ditemukan'); ?></h1>
                            <p><?php echo htmlspecialchars($parentfatherData['address'] ?? 'Tidak ditemukan'); ?></p>
                        </div>
                    </div>
                    <form>
                        <div class="profile-info">
                            <div class="input-group">
                                <label for="name">Nama Depan</label>
                                <input type="text" id="name" name="name" value="<?php echo $fa_firstName; ?>" disabled>
                            </div>
                            <div class="input-group">
                                <label for="fullname">Nama Belakang</label>
                                <input type="text" id="fullname" name="fullname" value="<?php echo $fa_lastName; ?>" disabled>
                            </div>
                            <div class="input-group">
                                <label for="location">ALamat</label>
                                <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($parentfatherData['address'] ?? 'Tidak ditemukan'); ?>" disabled>
                            </div>
                            <div class="input-group">
                                <label for="phone">No.Telepon</label>
                                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($formattedPhoneNumber); ?>" disabled>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown">
                <div class="dropdown-header" onclick="toggleDropdown('mother-details')">
                    Data Ibu <i class="fas fa-chevron-down"></i>
                </div>
                <div class="dropdown-content" id="mother-details">
                    <div class="profile-section">
                        <div class="profile-header">
                            <img src="<?php echo $imageURL; ?>" alt="Profile Picture">
                            <div>
                                <h1><?php echo htmlspecialchars($parentmotherData['name'] ?? 'Tidak ditemukan'); ?></h1>
                                <p><?php echo htmlspecialchars($parentmotherData['address'] ?? 'Tidak ditemukan'); ?></p>
                            </div>
                        </div>
                        <form>
                            <div class="profile-info">
                                <div class="input-group">
                                    <label for="name">Nama Depan</label>
                                    <input type="text" id="name" name="name" value="<?php echo $mo_firstName; ?>" disabled>
                                </div>
                                <div class="input-group">
                                    <label for="fullname">Nama Belakang</label>
                                    <input type="text" id="fullname" name="fullname" value="<?php echo $mo_lastName; ?>" disabled>
                                </div>
                                <div class="input-group">
                                    <label for="location">ALamat</label>
                                    <input type="text" id="location" name="location" value="<?php echo htmlspecialchars($parentmotherData['address'] ?? 'Tidak ditemukan'); ?>" disabled>
                                </div>
                                <div class="input-group">
                                    <label for="phone">No.Telepon</label>
                                    <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($formattedPhoneNumber); ?>" disabled>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        function toggleDropdown(id) {
            var content = document.getElementById(id);
            var icon = content.previousElementSibling.querySelector("i");
            if (content.style.display === "block") {
                content.style.display = "none";
                icon.classList.remove("fa-chevron-up");
                icon.classList.add("fa-chevron-down");
            } else {
                content.style.display = "block";
                icon.classList.remove("fa-chevron-down");
                icon.classList.add("fa-chevron-up");
            }
        }

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