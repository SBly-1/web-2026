<?php
include 'timeHelpers.php';
include 'postsData.php';
if (isset($_GET['postId'])) {
    $postId = $_GET['postId'];
}
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>post</title>
        <link href="static/css/home.css" rel="stylesheet">
        <script src="static/js/post.js" defer></script>
    </head>
    <body>
        <div class="home">
            <div class="sidebar">
                <a class="sidebar__item" href="home">
                    <img class="sidebar__icon sidebar__item_active" 
                        src="static/images/icon_home_active.png" alt="Домой">
                </a>
                <a class="sidebar__item" href="profile">
                    <img class="sidebar__icon" src="static/images/icon_profile.png" alt="Профиль">
                </a>
                <a class="sidebar__item" href="#">
                    <img class="sidebar__icon" src="static/images/icon_add.png" alt="Добавить">
                </a>
            </div>
            <main class="content">
                <!-- <h1> postId = <?= $postId ?></h1> -->
                <?php 
                $exists = false;
                foreach ($posts as $post) {
                    if ($postId == $post['id']) {
                        include 'post_preview.php';
                        $exists = true;
                    }
                }
                if (!$exists) {
                    http_response_code(400);
                    echo 'Нет нужных постов';
                }
                ?>
            </main>
        </div>
    </body>
</html>