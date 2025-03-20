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
    <title>Featured News</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
            background-color: #f4f4f4;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background: white;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.2);
            padding: 15px;
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh; /* Full height */
            overflow-y: auto; /* Enable scrolling if content overflows */
        }

        .sidebar .menu-title {
            font-size: 1.2em;
            margin-top: 5px;
            margin-bottom: 10px;
            color: #006400;
            font-weight: bold;
            text-align: left;
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

        .featured-news {
            display: flex;
            flex-direction: row;
            margin-bottom: 20px;
            max-width: 1000px;
            width: 100%;
        }
        .featured-text {
            margin-left: 20px;
            display: flex;
            flex-direction: column;
            text-align: left;
        }
        .featured-news img {
            max-width: 600px;
            height: auto;
            border-radius: 10px;
        }
        .featured-news h2 {
            margin: 10px 0;
            font-size: 24px;
        }
        .featured-news p {
            font-size: 16px;
            color: #555;
        }
        .scrollable-news {
            display: flex;
            overflow-x: auto;
            white-space: nowrap;
            padding: 10px;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            scrollbar-width: thin; /* Ensure scrollbar is always visible */
            scrollbar-color: #888 #f4f4f4; /* Customize scrollbar color */
        }
        .scrollable-news::-webkit-scrollbar {
            height: 8px; /* Set scrollbar height */
        }
        .scrollable-news::-webkit-scrollbar-track {
            background: #f4f4f4; /* Track color */
            border-radius: 4px;
        }
        .scrollable-news::-webkit-scrollbar-thumb {
            background: #888; /* Thumb color */
            border-radius: 4px;
        }
        .scrollable-news::-webkit-scrollbar-thumb:hover {
            background: #555; /* Thumb color on hover */
        }
        .news-item {
            flex: 0 0 auto;
            margin-right: 20px; /* Increased gap between items */
            position: relative;
            cursor: pointer;
            width: 390px;
            height: 250px;
            border-radius: 10px;
            overflow: hidden;
        }
        .news-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .news-item .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            padding: 10px;
            text-align: center;
        }
        .news-item:hover .overlay {
            opacity: 1;
        }

        .container {
            margin: 0;
            padding: 0;
            display: flex;
            min-height: 100vh;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>
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

    <div class="container">
    <?php if (!empty($featured_news)): ?>
        <!-- Featured News Section -->
        <div class="featured-news">
            <?php $first_news = array_shift($featured_news); ?>
            <img src="<?php echo $first_news['image']; ?>" alt="<?php echo htmlspecialchars($first_news['title']); ?>">
            <div class="featured-text">
                <h2><?php echo htmlspecialchars($first_news['title']); ?></h2>
                <p><?php echo htmlspecialchars($first_news['description']); ?></p>
            </div>
        </div>

        <!-- Scrollable News Section -->
        <div class="scrollable-news">
            <?php foreach ($featured_news as $news): ?>
                <div class="news-item">
                    <img src="<?php echo $news['image']; ?>" alt="<?php echo htmlspecialchars($news['title']); ?>">
                    <div class="overlay">
                        <p><?php echo htmlspecialchars($news['title']); ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No featured news available.</p>
    <?php endif; ?>
    </div>
        <script>
            // Sidebar Toggle
            const hamburger = document.getElementById('hamburger');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            hamburger.addEventListener('click', () => {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
                hamburger.classList.toggle('open');
                
                if (sidebar.classList.contains('active')) {
                    sidebar.style.right = "0";
                } else {
                    sidebar.style.right = "-250px";
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