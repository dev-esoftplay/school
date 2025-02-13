<?php
if (!defined('_VALID_BBC'))
    exit('No direct script access allowed');

$sys->set_layout('teacher.php');

$article = [
    "title" => "Important Announcement from the Principal",
    "description" => "Dear students and teachers, we are pleased to announce that the annual school event will take place next month. Please stay tuned for further details. Attendance is mandatory for all staff and students.",
    "category" => "School Announcement",
    "read_time" => "2 min read",
    "image" => "https://img.freepik.com/free-photo/group-students-graduation-gown-standing-campus_1150-11021.jpg",
    "source" => "Principal's Office",
    "time" => "1 hour ago"
];

// Latest School News Data
$school_news = [
    [
        "title" => "Midterm Exams Schedule Released",
        "category" => "Exams",
        "image" => "https://img.freepik.com/free-photo/close-up-still-life-hard-exams_23-2149314030.jpg?t=st=1738902113~exp=1738905713~hmac=c7f4e0b0243ac9fce21c90bf828821cb108a64329b3d58224ce4cfa009a97537&w=1380",
        "time" => "2 days ago",
        "read_time" => "5 min read"
    ],
    [
        "title" => "Annual Science Fair Next Month",
        "category" => "Events",
        "image" => "https://media.wired.com/photos/59272bc4cefba457b079c4c2/master/pass/DP14G4.jpg",
        "time" => "1 week ago",
        "read_time" => "3 min read"
    ],
    [
        "title" => "New Library Books Available for Students",
        "category" => "Library",
        "image" => "https://img.freepik.com/free-photo/young-student-looking-book-library_23-2149215403.jpg?t=st=1738902280~exp=1738905880~hmac=01b7380446e78b21ab27f9064bf4372c5e2cd9460719f0399fa3d6cbd2d15f74&w=1380",
        "time" => "3 days ago",
        "read_time" => "4 min read"
    ],
    [
        "title" => "Sports Day Registration Now Open",
        "category" => "Sports",
        "image" => "https://img.freepik.com/free-photo/low-angle-team-putting-hands-together_23-2149457259.jpg?t=st=1738902337~exp=1738905937~hmac=9c52ec3dd40bf0eee412f006122c3368c7ddf3488ee91156fe91f901d67252f4&w=1380",
        "time" => "5 days ago",
        "read_time" => "6 min read"
    ]
];

// Sample Featured News Data
$featured_news = [
    [
        "title" => "The current principal is about to retire and has already found a replacement",
        "category" => "School Announcement",
        "image" => "https://img.freepik.com/free-photo/man-teacher-wearing-glasses-checking-class-register-looking-puzzled-sitting-school-desk-front-blackboard-classroom_141793-131757.jpg?t=st=1738903545~exp=1738907145~hmac=66033f5f83cd148b154338919bc6b1e316f1461e3459a11f8d320752ab0f87e6&w=1380",
        "time" => "1 hour ago"
    ],
    [
        "title" => "Top Performing Students in National Exams Revealed",
        "category" => "Achievements",
        "image" => "https://img.freepik.com/free-photo/young-muslim-student-class_53876-14377.jpg?t=st=1738903739~exp=1738907339~hmac=e19be35dfa8b91f1e685f581bac2f9e0efa9d892abad9dfa9f8e12f01e97de06&w=1380",
        "time" => "2 days ago"
    ],
    [
        "title" => "High School Robotics Team Wins Regional Competition",
        "category" => "Extracurricular",
        "image" => "https://media.team254.com/2022/04/969b07ce-Picture11.jpg",
        "time" => "4 days ago"
    ],
    [
        "title" => "Upcoming Parent-Teacher Meeting: Schedule & Details",
        "category" => "Events",
        "image" => "https://2716595.fs1.hubspotusercontent-na1.net/hubfs/2716595/parent-teacher-conference_11zon.jpg",
        "time" => "5 days ago"
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Announcement</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        html, body {
            overflow-x: hidden;
            width: 100%;
        }

        h2{
            margin: 0px;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            overflow-x: hidden; /* Prevents horizontal scrolling */
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

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
            text-align: center;
        }

        /* Header */
        .header-container {
            background: rgba(217, 217, 217, .3);
            padding: 15px;
            border-radius: 8px;
            margin-top: 0px;
            margin: auto;
            max-width: 90%;
        }

        .header-container h2 {
            font-size: 18px;
            color: red;
            text-align: center;
        }
        
        /* Article Container */
        .article-wrapper {
            max-width: 90%;
            margin: 50px auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        /* Image */
        .article-wrapper img {
            width: 100%;
            max-width: 400px;
            border-radius: 10px;
        }

        /* Article Content - Follows the Image Width */
        .article-content {
            max-width: 500px; /* Matches max-width of the image */
            min-width: 380px; /* Minimum width for smaller screens */
            text-align: center;
            padding: 20px;
        }

        .article-title {
            font-size: 20px;
            font-weight: bold;
            margin-top: 10px;
        }

        .article-description {
            font-size: 16px;
            color: #555;
            margin-top: 10px;
        }

        .article-meta {
            font-size: 14px;
            color: #888;
            margin-top: 10px;
        }

        /* Latest News Section */
        .latest-news {
            max-width: 90%;
            margin: 50px auto;
        }

        .latest-news-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .latest-news-header h2 {
            font-size: 20px;
            font-weight: bold;
        }

        .see-all {
            font-size: 14px;
            color: red;
            text-decoration: none;
        }

        .news-container {
            display: flex;
            gap: 15px;
            overflow-x: auto;
            padding-bottom: 10px;
        }

        .news-card {
            min-width: 250px;
            max-width: 250px;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        .news-card img {
            width: 100%;
            height: 140px;
            object-fit: cover;
        }

        .news-content {
            padding: 10px;
        }

        .news-category {
            font-size: 12px;
            color: red;
            margin-bottom: 5px;
        }

        .news-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .news-meta {
            font-size: 12px;
            color: gray;
        }

        /* Featured News Section */

        .featured-news-section {
            max-width: 90%;
            margin: 50px auto;
            margin-bottom: 10px;
        }


        .featured-news {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); /* Dynamic grid */
            gap: 15px;
            justify-content: center;
            max-width: 90%;
            margin-left: 15px;
        }

        /* Featured News Cards */
        .featured-card {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .featured-card:hover {
            transform: scale(1.03);
        }

        .featured-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 12px;
        }

        /* Overlay for text */
        .featured-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 15px;
            border-radius: 0 0 12px 12px;
        }

        .featured-category {
            font-size: 12px;
            color: #ffcc00;
            text-transform: uppercase;
        }

        .featured-title {
            font-size: 16px;
            font-weight: bold;
            margin-top: 5px;
        }

        /* Responsive Grid */
        @media (max-width: 768px) {
            .featured-news {
                grid-template-columns: repeat(2, 1fr); /* Two items per row on tablets */
            }
        }

        @media (max-width: 480px) {
            .featured-news {
                grid-template-columns: 1fr; /* One item per row on mobile */
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="overlay" id="overlay"></div>
    <button class="hamburger" id="hamburger">☰</button>
    <div class="sidebar" id="sidebar">
        <div class="menu-title">SDIT ERAPORT</div>
        <div class="menu-list">
            <ul>
                <li><a href="teacher/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="teacher/class"><i class="fas fa-chalkboard"></i> Kelas</a></li>
                <li><a href="teacher/announcement" class="active"><i class="fas fa-bullhorn"></i> Pengumuman</a></li>
                <li><a href="teacher/score"><i class="fas fa-pencil-alt"></i> Input Nilai</a></li>
                <li><a href="teacher/profile"><i class="fas fa-user"></i> Profil</a></li>
            </ul>
        </div>
        <div class="logout-link">
            <a href="teacher/logout"><i class="fas fa-sign-out-alt"></i> Keluar</a>
        </div>

        <div class="footer">
            <?php echo config('site', 'footer'); ?>
            <?php echo $sys->block_show('footer'); ?>
        </div>
    </div>

    <!-- Header -->
    <div class="header-container">
        <h2>WELCOME TO SCHOOL BULLETIN</h2>
    </div>

    <!-- Article Container -->
    <div class="article-wrapper">
        <img src="<?php echo $article['image']; ?>" alt="School Announcement Image">
        <div class="article-content">
            <div class="article-title"><?php echo $article['title']; ?></div>
            <div class="article-description"><?php echo $article['description']; ?></div>
            <div class="article-meta"><?php echo $article['category']; ?> • <?php echo $article['read_time']; ?></div>
        </div>
    </div>

    <!-- Latest News Section -->
    <div class="latest-news">
        <div class="latest-news-header">
            <h2>Latest School Updates</h2>
            <a href="all-news.php" class="see-all">See all →</a>
        </div>
        <div class="news-container">
            <?php foreach ($school_news as $item): ?>
                <div class="news-card">
                    <img src="<?php echo $item['image']; ?>" alt="News Image">
                    <div class="news-content">
                        <div class="news-category"><?php echo $item['category']; ?></div>
                        <div class="news-title"><?php echo $item['title']; ?></div>
                        <div class="news-meta"><?php echo $item['time']; ?> • <?php echo $item['read_time']; ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Featured News Section -->
    <div class="featured-news-section">
        <div class="latest-news-header">
            <h2>Featured News</h2>
            <a href="all-featured-news.php" class="see-all">See all →</a>
        </div>
        <div class="featured-news">
            <?php foreach ($featured_news as $item): ?>
                <div class="featured-card" data-category="<?php echo $item['category']; ?>">
                    <img src="<?php echo $item['image']; ?>" alt="News Image">
                    <div class="featured-overlay">
                        <div class="featured-category"><?php echo $item['category']; ?> | <?php echo $item['time']; ?></div>
                        <div class="featured-title"><?php echo $item['title']; ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        const hamburger = document.getElementById('hamburger');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        hamburger.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
            hamburger.textContent = sidebar.classList.contains('active') ? '×' : '☰';
            hamburger.classList.toggle('open');
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
