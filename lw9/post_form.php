<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>post_form</title>
        <link href="static/css/common.css" rel="stylesheet">
        <link href="static/css/post_form.css" rel="stylesheet">
        <script src="static/js/post_form.js" defer></script>
    </head>
    <body>
        <div class="page">
            <div class="sidebar">
                <a class="sidebar__item" href="home">
                    <img class="sidebar__icon" src="static/images/icon_home.png" alt="Домой">
                </a>
                <a class="sidebar__item" href="profile">
                    <img class="sidebar__icon" src="static/images/icon_profile.png" alt="Профиль">
                </a>
                <a class="sidebar__item" href="post_form">
                    <img class="sidebar__icon sidebar__item_active" 
                        src="static/images/icon_add.png" alt="Добавить">
                </a>
            </div>
            <main class="post-form">
                <div class="post-form__media">
                    <img class="post-form__placeholder-icon" src="static/images/picture_icon.png" alt="Значок картинки">
                    <button class="post-form__add-photo-button post-form__add-photo-button_primary" type="button">Добавить фото</button>
                    <div class="post-form__slider" hidden>
                        <button class="post-form__slider-button post-form__slider-button_prev" type="button">
                            <img class="post-form__slider-button-icon" 
                                src="static/images/slider_arrow_prev.png" alt="Стрелка назад">
                        </button>
                        <img class="post-form__image" alt="">
                        <button class="post-form__slider-button post-form__slider-button_next" type="button">
                            <img class="post-form__slider-button-icon" 
                                src="static/images/slider_arrow_next.png" alt="Стрелка вперёд">
                        </button>
                        <span class="post-form__image-count">
                            <span class="post-form__image-count-current">1</span> из 
                            <span class="post-form__image-count-all">1</span>
                        </span>
                    </div>
                </div>
                <input class="post-form__photo-input" type="file" accept="image/*" multiple hidden>
                <div class="post-form__photo-limit-message" hidden>
                    <span>&#128526;</span>
                    <span>Вы добавили максимум фото, круто!</span>
                </div>
                <button class="post-form__add-photo-button post-form__add-photo-button_secondary" type="button">
                    <img class="post-form__plus-icon" src="static/images/plus.png" alt="Плюс">
                    Добавить фото
                </button>
                <textarea class="post-form__caption" name="content" placeholder="Добавьте подпись..."></textarea>
                <button class="post-form__share-button" type="button" disabled>Поделиться</button>
            </main>
        </div>
    </body>
</html>