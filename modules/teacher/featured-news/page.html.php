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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f4f4f4;
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
            display:flex;
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
            justify-content: center;
        }
        .news-item {
            flex: 0 0 auto;
            margin-right: 10px;
            position: relative;
            cursor: pointer;
            width: 500px;
            height: 350px;
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
    </style>
</head>
<body>
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
</body>
</html>