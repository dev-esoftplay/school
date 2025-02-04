<?php
if (!defined('_VALID_BBC'))
    exit('No direct script access allowed');

// Set the layout for the teacher dashboard
$sys->set_layout('teacher.php');

$user_id = $user->id;
$teacher_id = $db->getOne("SELECT id FROM school_teacher WHERE user_id = $user_id", array($user->id));
$position = $db->getOne("SELECT position FROM school_teacher WHERE id = $teacher_id", array($teacher_id));
$classes = $db->getAll("SELECT grade, label FROM school_class WHERE id = $teacher_id", array($teacher_id));

// $class_ids = $db->getCol("SELECT class_id FROM school_student_class WHERE class_id = $user_id", array($user->id));

// // Count how many times the $user_id appears in the class_ids
// $student_count = $db->getOne("SELECT COUNT(*) FROM school_student_class WHERE class_id = ? AND student_id = ?", array($class_ids, $user_id));


pr($data, $_SESSION, $user->id, $teacher_id, $position, $class_ids, $student_count);

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

        /* Create a 2x2 grid for the dashboard sections */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px; /* Space between the grid items */
        }

        /* Dashboard Section (Card) Styles */
        .dashboard-section {
            background: white;
            padding: 20px; /* Padding inside each card */
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px; /* Space between cards */
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
    </style>
</head>
<body>
    <!-- Sidebar and Hamburger Button -->
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

    <!-- Page Content -->
    <div class="dashboard">
        <div class="breadcrumb">Teacher Dashboard</div>

        <!-- Create the Grid Layout for the 4 Cards -->
        <div class="dashboard-grid">
            <!-- First Dashboard Section -->
            <div class="dashboard-section">
                <h2>Loading...</h2>
                <ul>
                    <?php if (!empty($claswdadwawdses)) { ?>
                        <?php foreach ($dwadw as $class) { ?>
                            <li><?php echo htmlspecialchars($class['name']); ?></li>
                        <?php } ?>
                    <?php } else { ?>
                        <p>Jumlah Siswa di Kelas yang Diampu</p>
                    <?php } ?>
                </ul>
            </div>

            <!-- Second Dashboard Section -->
            <!-- Second Dashboard Section -->
            <div class="dashboard-section">
                <h2>Position</h2>
                <ul>
                    <?php if (!empty($position)) { ?>
                        <p><?php echo htmlspecialchars($position); ?></p>
                    <?php } else { ?>
                        <p>No position available</p>
                    <?php } ?>
                </ul>
            </div>

        </div>

        <div class="dashboard-grid">
            <!-- Third Dashboard Section -->
            <div class="dashboard-section">
                <h2>Loading...</h2>
                <ul>
                    <?php if (!empty($students)) { ?>
                        <?php foreach ($students as $student) { ?>
                            <li><?php echo htmlspecialchars($student['name']); ?></li>
                        <?php } ?>
                    <?php } else { ?>
                        <p>Jumlah Kelas yang Diampu</p>
                    <?php } ?>
                </ul>
            </div>

            <!-- Fourth Dashboard Section -->
            <div class="dashboard-section">
                <h2>Kelas Yang Diampu</h2>
                <ul>
                    <?php if (!empty($classes)) { ?>
                        <?php foreach ($classes as $class) { ?>
                            <p>Kelas <?php echo htmlspecialchars($class['grade']); ?><?php echo htmlspecialchars($class['label']); ?></p>
                        <?php } ?>
                    <?php } else { ?>
                        <p>No classes available.</p>
                    <?php } ?>
                </ul>
            </div>

        </div>

        <!-- Bar Chart Section (Below the Cards) -->
        <div class="chart-section">
            <canvas id="performanceChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Data for the bar chart (Average grades for each class)
            const data = {
                labels: ['Class 1', 'Class 2', 'Class 3', 'Class 4'], // Example class names
                datasets: [{
                    label: 'Average Grades', // The name of the dataset
                    data: [85, 75, 90, 80], // Example average grades for the classes
                    backgroundColor: '#36A2EB', // Bar color
                    borderColor: '#36A2EB', // Border color for the bars
                    borderWidth: 1, // Width of the border
                    barThickness: 20 // Narrow the bars by reducing the thickness
                }]
            };

            // Configuration options for the bar chart
            const config = {
                type: 'bar', // Change the chart type to 'bar'
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.raw + '%'; // Format the tooltip to show percentage
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true, // Start the Y-axis from 0
                            ticks: {
                                stepSize: 10, // Set the step size for ticks (e.g., 10, 20, 30)
                                callback: function(value) {
                                    return value + '%'; // Show percentage on the Y-axis
                                }
                            }
                        }
                    }
                }
            };

            // Create the bar chart using the canvas element
            const ctx = document.getElementById('performanceChart').getContext('2d');
            new Chart(ctx, config);
        </script>

    <script>
            const hamburger = document.getElementById('hamburger');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            const activePage = window.location.pathname;
            const navLinks = document.querySelectorAll('.menu-list ul li a');

            navLinks.forEach(link => {
                if (link.href.includes(${activePage})) {
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