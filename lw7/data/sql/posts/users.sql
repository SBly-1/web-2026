USE blog;
INSERT INTO 
    user (
        user_name,
        avatar_url,
        bio
    )
VALUES (
    'Ваня Денисов',
    'static/images/avatar_ivan.png',
    'Привет! Я системный аналитик в ACME :) Тут моя жизнь только для самых классных!'
);

INSERT INTO 
    user (
        user_name,
        avatar_url
    )
VALUES (
    'Лиза Дёмина',
    'static/images/avatar_liza.png'
);