<?php
include 'timeHelpers.php';
include 'postsData.php';
?>

<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>home</title>
        <link href="static/css/home.css" rel="stylesheet">
    </head>
    <body>
        <div class="home">
            <div class="sidebar">
                <a class="sidebar__item" href="#">
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
                <?php 
                foreach ($posts as $post) {
                    include 'post_preview.php';
                }
                ?>
            </main>
        </div>
    </body>
</html>