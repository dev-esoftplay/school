<?php
if (!defined('_VALID_BBC'))
    exit('No direct script access allowed');

// Set the layout for the teacher dashboard
$sys->set_layout('teacher.php');

// Example dashboard data fetching
$teacher_id = $_SESSION['user_id']; // Assuming teacher's ID is stored in the session

// Fetch data from the database (replace 'your_table' and queries as needed)
$assignments = $db->getAll("SELECT * FROM assignments WHERE teacher_id = {$teacher_id} ORDER BY due_date ASC");
$students = $db->getAll("SELECT * FROM students WHERE class_id IN (SELECT class_id FROM classes WHERE teacher_id = {$teacher_id})");
$classes = $db->getAll("SELECT * FROM classes WHERE teacher_id = {$teacher_id}");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <style>
        /* General Styles */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            max-width: 375px; /* Simulate mobile screen width */
            margin: 0 auto;
            background-color: #f4f4f4;
            overflow-x: hidden;
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

        .dashboard-section {
            margin-bottom: 20px;
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .dashboard-section h2 {
            font-size: 1.4em;
            margin-bottom: 10px;
            color: #333;
        }

        .dashboard-section ul {
            list-style-type: none;
            padding: 0;
        }

        .dashboard-section ul li {
            margin: 5px 0;
            padding: 10px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
        }

        .dashboard-section ul li:not(:last-child) {
            margin-bottom: 10px;
        }

        p {
            margin: 0;
            font-size: 1em;
            color: #666;
        }

        /* Hamburger Button */
        .hamburger {
            font-size: 20px;
            background: none;
            border: none; /* Removed border */
            cursor: pointer;
            position: fixed;
            top: 15px;
            right: 20px; /* Place it on the right side */
            z-index: 1000;
            transition: transform 0.3s ease; /* Smooth transition for rotating */
        }

        /* When sidebar is open, rotate the hamburger icon */
        .hamburger.open {
            transform: rotate(90deg); /* Simple rotation effect for hamburger */
        }

        /* Overlay */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Slightly darker background */
            z-index: 998;
            display: none; /* Hidden by default */
        }

        .overlay.active {
            display: block;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            right: -250px; /* Hidden by default */
            width: 250px;
            height: 100%;
            background: white;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.2);
            z-index: 999;
            transition: right 0.3s ease; /* Smooth transition for sliding */
            padding: 15px;
            display: flex;
            flex-direction: column;
        }

        .sidebar.active {
            right: 0; /* Show the sidebar */
        }

        .sidebar .menu-title {
            font-size: 1.2em;
            margin-top: 5px;
            margin-bottom: 10px; /* Add space between title and the list */
            color: #006400;
            font-weight: bold;
            text-align: left;
        }

        .sidebar .menu-list {
            flex-grow: 1; /* Takes remaining space */
            display: flex;
            flex-direction: column;
            justify-content: flex-start; /* Align items at the top */
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
            text-decoration: none; /* Remove underline by default */
            color: black; /* Set text color to black */
            padding: 10px; /* Add padding for better spacing */
            border-radius: 5px; /* Rounded corners */
            display: block; /* Make the anchor a block element for full-width */
        }

        /* Hover effect for the links */
        .sidebar .menu-list ul li a:hover {
            background-color: #d3f4d1; /* Light green background */
            color: #3E7B27; /* Dark green text color */
            text-decoration: none; /* Ensure no underline on hover */
        }

        /* Active link (current page) style */
        .sidebar .menu-list ul li a.active {
            background-color: #d3f4d1; /* Light green background */
            color: #3E7B27; /* Dark green text color */
            font-weight: bold; /* Optionally bold the active link */
            text-decoration: none; /* Ensure no underline */
        }

        .sidebar .menu-list ul li a i {
            margin-right: 10px; /* Adds space between the icon and text */
            color: #333; /* Sets the icon color */
        }

        /* Footer */
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
            text-align: center;
        }

        /* Styles for the Logout link */
        .sidebar .logout-link a {
            color: red; /* Default text color for logout link */
            background-color: transparent; /* Transparent background */
            padding: 12px 15px; /* Adjusted padding for the logout button */
            border-radius: 5px;
            font-weight: bold;
            display: block;
        }

        .sidebar .logout-link a:hover {
            text-decoration: none;
            background-color: red; /* Red background on hover */
            color: white; /* White text color on hover */
        }

        .logout-link {
            margin-top: auto; /* Push the logout link to the bottom */
        }
    </style>
</head>
<body>
    <!-- SideBar And Hamburger Button -->
    <div class="overlay" id="overlay"></div>
    <button class="hamburger" id="hamburger">☰</button>
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

    <!-- Page View -->

    <div class="dashboard">
        <!-- Breadcrumb Title -->
        <div class="breadcrumb">Teacher Dashboard</div>

        <div class="dashboard-section">
            <h2>Your Classes</h2>
            <ul>
                <?php if (!empty($classes)) { ?>
                    <?php foreach ($classes as $class) { ?>
                        <li><?php echo htmlspecialchars($class['name']); ?></li>
                    <?php } ?>
                <?php } else { ?>
                    <p>No classes assigned yet.</p>
                <?php } ?>
            </ul>
        </div>

        <div class="dashboard-section">
            <h2>Assignments</h2>
            <ul>
                <?php if (!empty($assignments)) { ?>
                    <?php foreach ($assignments as $assignment) { ?>
                        <li>
                            <?php echo htmlspecialchars($assignment['title']); ?>
                            (Due: <?php echo htmlspecialchars($assignment['due_date']); ?>)
                        </li>
                    <?php } ?>
                <?php } else { ?>
                    <p>No assignments available.</p>
                <?php } ?>
            </ul>
        </div>

        <div class="dashboard-section">
            <h2>Students</h2>
            <ul>
                <?php if (!empty($students)) { ?>
                    <?php foreach ($students as $student) { ?>
                        <li><?php echo htmlspecialchars($student['name']); ?></li>
                    <?php } ?>
                <?php } else { ?>
                    <p>No students enrolled yet.</p>
                <?php } ?>
            </ul>
        </div>
    </div>
    
    <script>
        const hamburger = document.getElementById('hamburger');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        // Sidebar highlights the active page
        const activePage = window.location.pathname;
        const navLinks = document.querySelectorAll('.menu-list ul li a');

        navLinks.forEach(link => {
            if (link.href.includes(`${activePage}`)) {
                link.classList.add('active');
            }
        });

        // Open or close the sidebar and apply transition to hamburger
        hamburger.addEventListener('click', () => {
            if (sidebar.classList.contains('active')) {
                // If sidebar is already open, close it
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                hamburger.textContent = '☰'; // Change icon back to hamburger
                hamburger.classList.remove('open'); // Remove rotation effect
            } else {
                // Otherwise, open the sidebar
                sidebar.classList.add('active');
                overlay.classList.add('active');
                hamburger.textContent = '×'; // Change icon to 'X'
                hamburger.classList.add('open'); // Apply rotation effect
            }
        });

        // Close sidebar when clicking outside
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            hamburger.textContent = '☰'; // Reset the icon to hamburger
            hamburger.classList.remove('open'); // Remove rotation effect
        });

    </script>
</body>
</html>

