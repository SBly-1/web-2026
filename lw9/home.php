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
        <script src="static/js/post.js" defer></script>
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
                <?php foreach ($posts as $post) {
                        include 'post_preview.php';
                    }
                ?>
            </main>
        </div>
        <div class="modal"></div>
        <template id="modal-template">
            <div class="modal__content">
                <button class="modal__close" type="button">×</button>
                <div class="modal__slider">
                    <button class="modal__slider-button modal__slider-button_prev" type="button">
                        <img class="modal__slider-button-icon" 
                            src="static/images/slider_arrow_prev.png" alt="Стрелка назад">
                    </button>
                    <img class="modal__image" src="" alt="">
                    <button class="modal__slider-button modal__slider-button_next" type="button">
                        <img class="modal__slider-button-icon" 
                            src="static/images/slider_arrow_next.png" alt="Стрелка вперёд">
                    </button>
                </div>
                <span class="modal__image-count">
                    <span class="modal__image-count-current">1</span> из 
                    <span class="modal__image-count-all">1</span>
                </span>
            </div>
        </template>
    </body>
</html>