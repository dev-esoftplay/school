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
            max-width: 90%;
            margin: 50px auto;
        }

        h1 {
            font-size: 24px;
            text-align: center;
            margin-bottom: 30px;
        }

        /* Main News Section */
        .main-news {
            display: grid;
            grid-template-columns: 3fr 2fr;
            gap: 15px;
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

        /* Responsive Grid */
        @media (max-width: 768px) {
            .main-news {
                grid-template-columns: 1fr;
            }

            .secondary-news .secondary-article {
                flex-direction: column;
            }

            .secondary-news .secondary-article img {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>All Latest News</h1>

        <!-- Main News Section -->
        <div class="main-news">
            <!-- Main Article -->
            <?php if (!empty($school_news)): ?>
                <div class="main-article">
                    <div class="main-article-content">
                        <div class="news-category"><?php echo $school_news[0]['category']; ?></div>
                        <div class="news-title"><?php echo $school_news[0]['title']; ?></div>
                        <div class="news-description"><?php echo $school_news[0]['description']; ?></div>
                        <div class="news-meta"><?php echo date('F j, Y, g:i a', strtotime($school_news[0]['created_at'])); ?></div>
                    </div>
                    <img src="<?php echo $school_news[0]['image']; ?>" alt="Main News Image">
                </div>
            <?php endif; ?>
            
            <!-- Secondary Articles -->
            <div class="secondary-news">
                <?php for ($i = 1; $i < count($school_news); $i++): ?>
                    <div class="secondary-article">
                        <img src="<?php echo $school_news[$i]['image']; ?>" alt="Secondary News Image">
                        <div class="secondary-article-content">
                            <div class="news-category"><?php echo $school_news[$i]['category']; ?></div>
                            <div class="news-title"><?php echo $school_news[$i]['title']; ?></div>
                            <div class="news-description"><?php echo $school_news[$i]['description']; ?></div>
                            <div class="news-meta"><?php echo date('F j, Y, g:i a', strtotime($school_news[$i]['created_at'])); ?></div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>

        <div class="back-button">
            <a href="teacher/announcement" onclick="redirectAndClose(event, 'announcement.php')">← Back to Home</a>
        </div>
    </div>

</body>
</html>
