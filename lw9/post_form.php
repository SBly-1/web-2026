<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <title>post</title>
        <link href="static/css/common.css" rel="stylesheet">
        <link href="static/css/post_form.css" rel="stylesheet">
        <script src="static/js/post_form.js" defer></script>
    </head>
    <body>
        <div class="post__form">
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
            <main class="form">
                <div class="form__media">
                    <img class="form__picture-example" src="static/images/picture_example.png" alt="Картинка пример">
                    <button class="form__media-add-photo">Добавить фото</button>
                </div>
                <button class="form__add-photo">
                    <img class="form__plus-icon" src="static/images/plus.png" alt="Плюс">
                    Добавить фото
                </button>
                <textarea class="form__add-text" placeholder="Добавьте подпись..."></textarea>
                <button class="form__share">Поделиться</button>
            </main>
        </div>
    </body>
</html>