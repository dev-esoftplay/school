<?php
if (!defined('_VALID_BBC')) {
    exit('No direct script access allowed');
}

$sys->set_layout('teacher.php');

// Get the ID from the URL
$news_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$news = $db->getRow("SELECT * FROM school_announcement_latest_news WHERE id = $news_id");

// Format the date into Indonesian format
setlocale(LC_TIME, 'id_ID.utf8');
$formatted_date = strftime('%d %B %Y, %H:%M WIB', strtotime($news['created_at']));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($news['title']); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #181818;
            padding: 20px;
            border-radius: 10px;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 10px;
        }

        .meta {
            color: #aaa;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .author {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .author img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .article-img {
            width: 100%;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .content {
            font-size: 16px;
            line-height: 1.6;
        }

        .reaction {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .reaction button {
            background: none;
            border: none;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .reaction button:hover {
            color: #f00;
        }

        .comment-section {
            margin-top: 30px;
        }

        .comment-box {
            width: 100%;
            padding: 10px;
            border: 1px solid #333;
            background: #222;
            color: #fff;
            border-radius: 5px;
        }

        .comment-list {
            margin-top: 10px;
        }

        .comment {
            padding: 10px;
            border-bottom: 1px solid #333;
        }

        .back-button {
            margin-top: 20px;
        }

        .back-button a {
            text-decoration: none;
            color: #f00;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1><?php echo htmlspecialchars($news['title']); ?></h1>
        <div class="meta">
            <span>SDIT Kudus- <?php echo $formatted_date; ?></span>
        </div>

        <div class="author">
            <img src="https://ui-avatars.com/api/?name=Editor&background=random&color=fff" alt="Editor">
            <span><strong><?php echo htmlspecialchars($teacherName ?: 'Tidak Diketahui'); ?></strong> <br> Editor</span>
        </div>

        <img src="<?php echo htmlspecialchars($news['image']); ?>" class="article-img" alt="News Image">

        <div class="content">
            <?php echo nl2br(htmlspecialchars($news['description'])); ?>
        </div>

        <!-- Reaction Buttons -->
        <div class="reaction">
            <button onclick="likePost()"><i class="fas fa-thumbs-up"></i> <span id="likeCount">9</span></button>
            <button onclick="dislikePost()"><i class="fas fa-thumbs-down"></i></button>
            <button onclick="sharePost()"><i class="fas fa-share"></i> Share</button>
        </div>

        <!-- Comment Section -->
        <div class="comment-section">
            <h3>Comments</h3>
            <textarea class="comment-box" placeholder="Write a comment..."></textarea>
            <div class="comment-list">
                <div class="comment">User123: This is an example comment!</div>
                <div class="comment">User456: Wow! Such an interesting news.</div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="back-button">
            <a href="javascript:history.back()">← Back to News</a>
        </div>
    </div>

    <script>
        function likePost() {
            let count = document.getElementById("likeCount").innerText;
            document.getElementById("likeCount").innerText = parseInt(count) + 1;
        }

        function dislikePost() {
            alert("You disliked this post.");
        }

        function sharePost() {
            alert("Share feature coming soon!");
        }
    </script>

</body>
</html>
