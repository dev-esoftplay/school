<?php
if (!defined('_VALID_BBC'))
    exit('No direct script access allowed');

$sys->set_layout('teacher.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Announcement</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* General Styles */
        html,
        body {
            overflow-x: hidden;
            width: 100%;
            scroll-behavior: smooth;
            /* Smooth scrolling */
            margin: 0;
            padding: 0;
            height: 100%;
            /* Ensure full height */
        }

        h2 {
            margin: 0px;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            overflow-x: hidden;
            display: flex;
            /* Use flexbox for layout */
            min-height: 100vh;
            /* Ensure body takes full viewport height */
        }

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
            font-size: 16.8px !important;
            margin-top: 5px;
            margin-bottom: 1px;
            color: #006400;
            font-weight: bold;
            text-align: left;
        }

        .sidebar .menu-list {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            font-size: 14px;
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
            font-size: 14px;
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

        /* Main Content */
        .main-content {
            flex: 1;
            /* Take remaining space */
            display: flex;
            flex-direction: column;
            height: 100vh;
            /* Match sidebar height */
            overflow-y: auto;
            /* Enable scrolling if content overflows */
        }

        /* Header */
        header.header-container {
            background: rgba(217, 217, 217, .3);
            padding: 15px;
            border-radius: 8px;
            margin: 20px auto;
            max-width: 90%;
            text-align: left;
        }

        header.header-container h2 {
            font-size: 20px;
            color: red;
            text-align: center;
        }

        /* Article Container */
        section.article-wrapper {
            max-width: 90%;
            margin: 20px auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .article-wrapper img {
            width: 100%;
            max-width: 400px;
            border-radius: 10px;
        }

        .article-content {
            max-width: 500px;
            min-width: 380px;
            text-align: center;
            /* Align text to the left */
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

        /* News Sections Container */
        .news-sections-container {
            display: flex;
            /* Use flexbox to split the screen */
            gap: 50px;
            /* Space between latest news and featured news */
            max-width: 90%;
            margin: 20px auto;
        }

        /* Latest News Section */
        section.latest-news {
            flex: 1;
            /* Take up 50% of the space */
            text-align: left;
            /* Align content to the left */
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
            text-align: left;
            /* Align text to the left */
        }

        .see-all {
            font-size: 14px;
            color: red;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .see-all:hover {
            color: darkred;
        }

        /* News Container - Responsive Grid */
        .news-container {
            display: flex;
            flex-direction: column;
            /* Default: Vertical for small screens */
            gap: 10px;
        }

        /* News Card - Default Layout */
        .news-card {
            display: flex;
            align-items: center;
            width: 100%;
            max-width: 600px;
            /* Adjusted width */
            background: white;
            padding: 10px;
            border-radius: 8px;
            gap: 12px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        /* Hover Effect */
        .news-card:hover {
            transform: scale(1.02);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        /* Image Styling */
        .news-card img {
            width: 70px;
            /* Adjusted for better scaling */
            height: 70px;
            object-fit: cover;
            border-radius: 5px;
        }

        /* News Content - Right Side */
        .news-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Category Styling */
        .news-category {
            font-size: 11px;
            color: red;
            font-weight: bold;
        }

        /* Title Styling */
        .news-title {
            font-size: 16px;
            font-weight: bold;
            margin: 3px 0;
        }

        /* Meta Info (Date, Author) */
        .news-meta {
            font-size: 12px;
            color: gray;
        }

        /* Featured News Section */
        section.featured-news-section {
            flex: 1;
            /* Take up 50% of the space */
            text-align: left;
            /* Align content to the left */
        }

        .featured-news {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }

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

        /* Back to Top Button */
        #back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            background: #006400;
            color: white;
            border: none;
            border-radius: 50%;
            padding: 10px;
            cursor: pointer;
            transition: opacity 0.3s ease;
            display: none;
        }

        #back-to-top:hover {
            background: #004d00;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            body {
                flex-direction: column;
                /* Stack sidebar and main content vertically */
            }

            .main-content {
                height: auto;
                /* Auto height on mobile */
            }

            .news-sections-container {
                flex-direction: column;
                /* Stack latest news and featured news vertically on mobile */
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
    </style>
</head>

<body>
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

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header class="header-container">
            <h2>SELAMAT DATANG DI</h2>
            <h2>BULETIN SEKOLAH</h2>
        </header>

        <!-- Article Container -->
        <section class="article-wrapper">
            <img src="<?php echo htmlspecialchars($article['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8'); ?>">
            <div class="article-content">
                <div class="article-title"><?php echo htmlspecialchars($article['title'], ENT_QUOTES, 'UTF-8'); ?></div>
                <div class="article-description"><?php echo htmlspecialchars($article['description'], ENT_QUOTES, 'UTF-8'); ?></div>
                <div class="article-meta"><?php echo htmlspecialchars($article['category'], ENT_QUOTES, 'UTF-8'); ?> • <?php echo htmlspecialchars($article['read_time'], ENT_QUOTES, 'UTF-8'); ?></div>
            </div>
        </section>

        <!-- News Sections Container -->
        <div class="news-sections-container">
            <!-- Latest News Section -->
            <section class="latest-news">
                <div class="latest-news-header">
                    <h2>Berita Terbaru</h2>
                    <a href="teacher/latestnews" class="see-all">lihat semua →</a>
                </div>
                <div class="news-container">
                    <?php foreach ($school_news as $item): ?>
                        <div class="news-card">
                            <img src="<?php echo htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8'); ?>"
                                alt="<?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
                            <div class="news-content">
                                <div class="news-category"><?php echo htmlspecialchars($item['category'], ENT_QUOTES, 'UTF-8'); ?></div>
                                <div class="news-title"><?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?></div>
                                <div class="news-meta">
                                    <span class="news-author">By <?php echo htmlspecialchars($item['author'], ENT_QUOTES, 'UTF-8'); ?></span> •
                                    <?php echo date('F j, Y', strtotime($item['created_at'])); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>

            <!-- Featured News Section -->
            <section class="featured-news-section">
                <div class="latest-news-header">
                    <h2>Berita Unggulan</h2>
                    <a href="teacher/featurednews" class="see-all">lihat semua →</a>
                </div>
                <div class="featured-news">
                    <?php foreach ($featured_news as $item): ?>
                        <div class="featured-card" data-category="<?php echo htmlspecialchars($item['category'], ENT_QUOTES, 'UTF-8'); ?>">
                            <img src="<?php echo htmlspecialchars($item['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
                            <div class="featured-overlay">
                                <div class="featured-category"><?php echo htmlspecialchars($item['category'], ENT_QUOTES, 'UTF-8'); ?> | <?php echo date('F j, Y, g:i a', strtotime($item['created_at'])); ?></div>
                                <div class="featured-title"><?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        </div>

        <!-- Back to Top Button -->
        <button id="back-to-top" title="Go to top">
            <i class="fas fa-arrow-up"></i>
        </button>
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

        // Back to Top Button
        window.addEventListener('scroll', () => {
            const backToTopButton = document.getElementById('back-to-top');
            if (window.scrollY > 300) {
                backToTopButton.style.display = 'block';
            } else {
                backToTopButton.style.display = 'none';
            }
        });

        document.getElementById('back-to-top').addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
</body>

</html>