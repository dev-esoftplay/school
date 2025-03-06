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
    <title>Student Dashboard</title>
    <style>
        /* General Styles */
        body {
            margin: 0;
            padding: 0;
            /* max-width: 375px; Simulate mobile screen width */
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

        /* Create a 2x2 grid for the dashboard sections */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 2fr 2fr;
            gap: 20px;
            /* Space between the grid items */
        }

        /* Dashboard Section (Card) Styles */
        .dashboard-section {
            background: white;
            padding: 20px;
            /* Padding inside each card */
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            /* Space between cards */
        }

        .dashboard-section h2 {
            font-size: 1.4em;
            margin-top: 0px;
            color: #333;
        }

        .dashboard-section ul {
            list-style-type: none;
            padding: 0;
        }

        .dashboard-section ul p:not(:last-child) {
            margin-bottom: 10px;
        }

        p {
            margin: 0;
            font-size: 1em;
            color: #666;
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
            position: sticky;
            top: 0;
        }

        .sidebar.active {
            transform: translateX(0);
        }

        .sidebar .menu-title {
            font-size: 1.2em;
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

        /* Bar Chart Section */
        .chart-section {
            margin-top: 20px;
            text-align: center;
        }

        /* Scrollable Announcement Section */
        .announcement-section {
            max-height: 200px;
            overflow: auto;
            white-space: nowrap;
            display: flex;
            flex-direction: column;
            gap: 5px; 
        }

        .announcement-container {
            display: flex;
            flex-direction: column;
            gap: 10px; 
            padding: 10px;
        }

        .announcement-item {
            display: flex;
            align-items: center;
            gap: 10px; /* Reduced gap between image and text */
            background: #f9f9f9;
            padding: 10px; /* Reduced padding */
            border-radius: 8px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
            min-width: 100%;
        }

        .announcement-item img {
            width: 75px;
            height: 75px;
            object-fit: cover;
            border-radius: 8px;
        }

        .announcement-text {
            flex-grow: 1;
        }

        .announcement-item h3 {
            font-size: 1em;
            margin: 0;
            color: #006400;
        }

        .announcement-item p {
            font-size: 0.9em;
            color: #333;
            margin: 5px 0;
        }

        .announcement-item small {
            font-size: 0.8em;
            color: #777;
        }

        /* Announcement Section */
        .announcement-section {
            max-height: 350px;
            overflow: auto;
            white-space: nowrap;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .announcement-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
            padding: 15px;
        }

        .announcement-item {
            background: #f9f9f9;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
            min-width: 100%;
        }

        .announcement-item h3 {
            font-size: 1.2em;
            margin: 0;
            color: #006400;
        }

        .announcement-item p {
            font-size: 1em;
            color: #333;
            margin: 5px 0;
        }

        .announcement-item small {
            font-size: 0.9em;
            color: #777;
        }

        .dashboard-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 20px;
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
                right: -250px; /* Start off-screen to the right */
                transition: transform 0.3s ease;
            }

            .sidebar.active {
                transform: translateX(-250px); /* Slide in from the right */
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
    </style>
</head>

<body>
    <!-- Overlay for mobile -->
    <div class="overlay"></div>
    <!-- Hamburger Button  -->
    <div class="overlay" id="overlay"></div>
    <button class="hamburger" id="hamburger">☰</button>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="menu-title">SDIT ERAPORT</div>
        <div class="menu-list">
            <div class="menu-separator">
                <div class="menu-1">
                    <ul>
                        <li><a href="student/dashboard" onclick="redirectAndClose(event, 'dashboard.php')"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                        <li><a href="student/score" onclick="redirectAndClose(event, 'score.php')"><i class="fas fa-book"></i></> Raport</a></li>
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

    <!-- Page Content -->
    <div class="main-content">
        <div class="dashboard">
            <div class="breadcrumb">Studentsg Dashboard</div>

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