<?php
if (!defined('_VALID_BBC'))
    exit('No direct script access allowed');

$sys->set_layout('teacher.php');
$_GET['id'] = !empty($_GET['id']) ? $_GET['id'] : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Latest News</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        /* Container */
        .container {
            max-width: 100%;
            margin: 50px auto;
        }

        h1 {
            font-size: 32px;
            text-align: left;
            margin-bottom: 0px;
            font-weight: bold;
        }

        h4 {
            font-size: 12px;
            color: gray;
            margin-top: 0px;
        }

        /* Main News Section */
        .main-news {
            display: grid;
            grid-template-columns: 3fr 2fr;
            gap: 50px;
            margin-bottom: 30px;
        }

        .main-news .main-article {
            border-radius: 10px;
            overflow: hidden;
            position: relative;
        }

        .main-news .main-article img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .main-news .main-article-content {
            padding: 20px;
            padding-left: 0px;
            padding-left: 0px;
        }

        .main-news .main-article .news-category {
            color: red;
            font-size: 14px;
        }

        .main-news .main-article .news-title {
            font-size: 22px;
            font-weight: bold;
            margin: 10px 0;
        }

        .news-title a {
            text-decoration: none;
            /* Remove default underline */
            color: black;
            /* Default color */
            transition: color 0.3s ease, text-decoration 0.3s ease;
        }

        .news-title a:hover {
            text-decoration: underline;
            /* Underline on hover */
            color: green;
            /* Change color on hover */
        }

        .main-news .main-article .news-description {
            font-size: 14px;
            color: gray;
            margin-bottom: 10px;
        }

        .main-news .main-article .news-meta {
            color: gray;
            font-size: 12px;
        }

        /* Secondary News Section */
        .secondary-news {
            display: grid;
            gap: 15px;
        }

        .secondary-news .secondary-article {
            display: flex;
            border-radius: 10px;
            overflow: hidden;
        }

        .secondary-news .secondary-article img {
            width: 40%;
            object-fit: cover;
        }

        .secondary-news .secondary-article-content {
            padding: 15px;
            width: 60%;
        }

        .secondary-news .secondary-article .news-category {
            color: red;
            font-size: 12px;
        }

        .secondary-news .secondary-article .news-title {
            font-size: 16px;
            font-weight: bold;
            margin: 5px 0;
        }

        .secondary-news .secondary-article .news-description {
            font-size: 13px;
            color: #555;
            margin-bottom: 5px;
        }

        .secondary-news .secondary-article .news-meta {
            font-size: 12px;
            color: gray;
        }

        .back-button {
            margin-top: 20px;
            text-align: center;
        }

        .back-button a {
            text-decoration: none;
            color: red;
            font-size: 14px;
        }

        /* Make the secondary news scrollable on small screens */
        @media (max-width: 768px) {
            .main-news {
                grid-template-columns: 1fr;
                /* Stack main news on mobile */
            }

            .main-news .main-article {
                display: flex;
                flex-direction: column-reverse;
                /* Swap image and text */
            }

            .main-news .main-article img {
                width: 100%;
                /* Full width on mobile */
                height: auto;
            }

            .main-news .main-article-content {
                padding: 15px;
            }

            .secondary-news {
                display: flex;
                overflow-x: auto;
                /* Enable horizontal scrolling */
                gap: 10px;
                padding-bottom: 10px;
                scroll-snap-type: x mandatory;
                /* Smooth snapping effect */
            }

            .secondary-article {
                flex: 0 0 auto;
                width: 300px;
                /* Set a fixed width */
                min-width: 280px;
                /* Ensures consistent size */
                scroll-snap-align: start;
                /* Snap to each article */
                display: flex;
                flex-direction: row;
                border-radius: 10px;
                overflow: hidden;
                background: white;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                height: auto;
            }

            .secondary-news .secondary-article img {
                width: 40%;
                /* Keep image on the left */
                height: 180px;
                object-fit: cover;
            }

            .secondary-news .secondary-article-content {
                padding: 15px;
                padding-bottom: 0px;
                padding-top: 5px;
                width: 70%;
                /* Keep text on the right */
                height: 180px;
                max-width: 300px;
                overflow: hidden;
                display: block;
            }

            /* Hide scrollbar for a cleaner look */
            .secondary-news::-webkit-scrollbar {
                display: none;
            }
        }

        /* Search Bar */
        .search-container {
            text-align: left;
            margin-bottom: 20px;
        }

        #searchInput {
            width: 100%;
            max-width: 400px;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Semua Berita Terbaru</h1>
        <h4>Berita terbaru terkait sekolah dalam waktu terkini</h4>

        <!-- Search Bar -->
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Cari berita..." onkeyup="searchNews()">
        </div>
        <!-- Main News Section -->
        <div class="main-news">
            <!-- Main Article -->
            <?php if (!empty($school_news)): ?>
                <div class="main-article">
                    <div class="main-article-content">
                        <div class="news-category"><?php echo $school_news[$_GET['id']]['category']; ?></div>
                        <div class="news-title"><a href="teacher/newsdetailpage/<?php echo $school_news[$_GET['id']]['id']; ?>"><?php echo $school_news[$_GET['id']]['title']; ?></a></div>
                        <div class="news-description"><?php echo $school_news[$_GET['id']]['description']; ?></div>
                        <div class="news-meta"><?php echo date('F j, Y, g:i a', strtotime($school_news[$_GET['id']]['created_at'])); ?></div>
                    </div>
                    <img src="<?php echo $school_news[$_GET['id']]['image']; ?>" alt="Main News Image">
                </div>
            <?php endif; ?>

            <!-- Secondary Articles -->
            <div class="secondary-news">
                <?php for ($i = 1; $i < count($school_news); $i++): ?>
                    <div class="secondary-article">
                        <img src="<?php echo $school_news[$i]['image']; ?>" alt="Secondary News Image">
                        <div class="secondary-article-content">
                            <div class="news-category"><?php echo $school_news[$i]['category']; ?></div>
                            <div class="news-title"><a href="teacher/newsdetailpage/<?php echo $school_news[$i]['id']; ?>"><?php echo $school_news[$i]['title']; ?></a></div>
                            <div class="news-description"><?php echo limitWords($school_news[$i]['description'], 8); ?></div>
                            <div class="news-meta"><?php echo date('F j, Y, g:i a', strtotime($school_news[$i]['created_at'])); ?></div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>

        <div class="back-button">
            <a href="teacher/announcement" onclick="redirectAndClose(event, 'announcement.php')">← Kembali ke Beranda</a>
        </div>
    </div>
    <script>
        let noResultsMessage = null; // Declare outside the function to maintain its state

        function searchNews() {
            let input = document.getElementById("searchInput").value.toLowerCase();
            let mainArticle = document.querySelector(".main-article");
            let secondaryNews = document.querySelector(".secondary-news");
            let articles = document.querySelectorAll(".secondary-article");
            let hasResults = false;

            // Handle layout changes when search input is not empty
            if (input.trim() !== "") {
                // Hide main article during search
                mainArticle.style.display = "none";

                // Adjust secondary news layout for search results
                secondaryNews.style.flexDirection = "column"; // Stack articles vertically
                secondaryNews.style.overflowX = "unset"; // Remove horizontal scroll
                secondaryNews.style.overflowY = "auto"; // Enable vertical scroll

                articles.forEach(article => {
                    article.style.marginTop = "15px"; // Add spacing between articles
                });
            } else {
                // Restore main article and default layout when input is empty
                mainArticle.style.display = "flex"; // Ensure main article is visible
                mainArticle.style.flexDirection = "column-reverse"; // Ensure image is above text on mobile

                // Restore default desktop & mobile layout
                if (window.innerWidth >= 768) {
                    secondaryNews.style.flexDirection = "column"; // Default vertical for desktop
                    secondaryNews.style.overflowX = "unset";
                    secondaryNews.style.overflowY = "unset"; // Remove forced scrolling
                } else {
                    secondaryNews.style.flexDirection = "row"; // Restore horizontal for mobile
                    secondaryNews.style.overflowX = "auto";
                    secondaryNews.style.overflowY = "unset";
                    secondaryNews.style.scrollSnapType = "x mandatory"; // Restore smooth scrolling
                }

                articles.forEach(article => {
                    article.style.marginTop = "0"; // Reset margin
                });

                // Remove noResultsMessage if input is empty
                if (noResultsMessage) {
                    noResultsMessage.remove();
                    noResultsMessage = null;
                }
            }

            // Filter articles based on search input
            articles.forEach(article => {
                let title = article.querySelector(".news-title").textContent.toLowerCase();
                let description = article.querySelector(".news-description").textContent.toLowerCase();

                if (title.includes(input) || description.includes(input)) {
                    article.style.display = "flex"; // Show matching articles
                    hasResults = true;
                } else {
                    article.style.display = "none"; // Hide non-matching articles
                }
            });

            // Display message if no articles match the search
            if (!hasResults && input.trim() !== "") {
                if (!noResultsMessage) {
                    noResultsMessage = document.createElement("p");
                    noResultsMessage.textContent = "Berita yang kamu cari tidak ada.";
                    noResultsMessage.style.position = "fixed";
                    noResultsMessage.style.top = "50%";
                    noResultsMessage.style.left = "50%";
                    noResultsMessage.style.transform = "translate(-50%, -50%)";
                    noResultsMessage.style.fontSize = "18px";
                    noResultsMessage.style.color = "black";
                    noResultsMessage.style.backgroundColor = "rgba(255, 255, 255, 0.8)";
                    noResultsMessage.style.padding = "20px";
                    noResultsMessage.style.borderRadius = "5px";
                    document.body.appendChild(noResultsMessage); // Show the message in the center of the screen
                }
            }
        }
    </script>
</body>
</html>
