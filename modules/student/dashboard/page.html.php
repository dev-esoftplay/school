<?php

use Google\Api\ResourceDescriptor\Style;

if (!defined('_VALID_BBC'))
    exit('No direct script access allowed');

// Set the layout for the teacher dashboard
$sys->set_layout('student.php');
// pr($_GET, $user->id, $teacherData, $classes, $recent_announcement);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
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
            margin-bottom: 20px;
        }

        p {
            margin: 0;
            font-size: 1em;
            color: white;
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
            /* Light green hover */
            color: white;
            /* Tetap kontras dengan warna putih */
        }

        .sidebar .logout-link a {
            background-color: #DC143C;
            /* Red background */
            color: white;
            /* White text */
            padding: 12px 15px;
            border-radius: 8px;
            font-weight: bold;
            display: block;
            transition: background-color 0.3s ease;
        }

        .sidebar .logout-link a:hover {
            background-color: #B80F0A;
            /* Darker red on hover */
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

            .dashboard-grid-2 {
                display: grid;
                grid-template-columns: 1fr;
            }

            .chart-section canvas {
                width: 65% !important;
                height: auto !important;
                max-width: 500px;
                max-height: 400px;
            }
        }

        /* Welcome Message */
        .welcome-message {
            background: linear-gradient(135deg, #3E7B27, #66BB6A);
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .welcome-message h1 {
            margin: 0;
            font-size: 1.8em;
        }

        .welcome-message p {
            margin: 5px 0 0;
            font-size: 1.1em;
        }

        /* Student Details Section */
        .student-details {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .student-details h2 {
            font-size: 1.4em;
            margin-top: 0;
            color: #333;
            border-bottom: 2px solid #3E7B27;
            padding-bottom: 10px;
        }

        .student-details p {
            margin: 10px 0;
            font-size: 1em;
            color: #666;
        }

        .student-details p strong {
            color: #333;
        }

        /* Quick Links Section */
        .quick-links {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .quick-links h2 {
            font-size: 1.4em;
            margin-top: 0;
            color: #333;
            border-bottom: 2px solid #3E7B27;
            padding-bottom: 10px;
        }

        .quick-links ul {
            list-style-type: none;
            padding: 0;
        }

        .quick-links ul li {
            margin: 10px 0;
        }

        .quick-links ul li a {
            text-decoration: none;
            color: #3E7B27;
            font-size: 1.1em;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: color 0.3s ease;
        }

        .quick-links ul li a:hover {
            color: #66BB6A;
        }

        /* Recent announcement Section */
        .recent-announcement {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .recent-announcement h2 {
            font-size: 1.4em;
            margin-top: 0;
            color: #333;
            border-bottom: 2px solid #3E7B27;
            padding-bottom: 10px;
        }

        .recent-announcement ul {
            list-style-type: none;
            padding: 0;
        }

        .recent-announcement ul li {
            margin: 10px 0;
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .recent-announcement ul li:last-child {
            border-bottom: none;
        }

        .recent-announcement ul li p {
            margin: 0;
            font-size: 1em;
            color: #666;
        }

        .recent-announcement ul li p strong {
            color: #333;
        }

        #profile_text {
            margin-left: 2px;
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
            <!-- Breadcrumb -->
            <!-- Welcome Message -->
            <div class="welcome-message">
                <h1>Halo, <?php echo $student_name; ?>! 👋</h1>
                <p>Selalu terinformasi mengenai perkembangan akademik dan pengumuman terkini.</p>
            </div>

            <!-- Student Details -->
            <div class="student-details">
                <h2>Student Details</h2>
                <p><strong>Kelas:</strong> <?= htmlspecialchars(str_replace(' ', '', $className . $labelClass), ENT_QUOTES, 'UTF-8') ?></p>
                <p><strong>Wali Kelas:</strong> <?php echo $teacher_Name; ?></p>
                <p><strong>Semester:</strong> Semester <?php echo $current_semester; ?></p>
            </div>

           
            <!-- Recent announcement -->
            <div class="recent-announcement">
                <h2>Pemberitahuan Terbaru</h2>
                <ul>
                    <?php foreach ($recent_announcement as $announcement): ?>
                        <li>
                            <p><strong><?php echo $announcement['title']; ?></strong></p>
                            <p><?php echo date('F j, Y', strtotime($announcement['created_at'])); ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
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
        </script>
    </div>
</body>

</html>