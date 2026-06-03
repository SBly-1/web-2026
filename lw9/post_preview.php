<div class="post">
    <div class="post__header">
        <img class="post__avatar" src="<?= $post['avatar'] ?>" 
            alt="аватар пользователя <?= $post['author'] ?>">
        <span class="post__author"><?= $post['author'] ?></span>
        <img class="post__edit" src="static/images/icon_edit.png" 
            alt="Редактировать">
    </div>
    <?php if (!empty($post['images'])): ?>
        <div class="post__media">
            <?php foreach ($post['images'] as $index => $image): ?>
                <img class="post__image <?= $index === 0 ? 'post__image_active' : '' ?>" 
                    src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>">
            <?php endforeach; ?>
            <?php if ($post['imageCount'] > 1): ?>
                <button class="post__slider-button post__slider-button_prev" type="button">
                    <img class="post__slider-button-icon" 
                        src="static/images/slider_arrow_prev.png" alt="Стрелка назад">
                </button>
                <button class="post__slider-button post__slider-button_next" type="button">
                    <img class="post__slider-button-icon" 
                        src="static/images/slider_arrow_next.png" alt="Стрелка вперёд">
                </button>
                <span class="post__image-count"> 
                    <span class="post__image-count-current">1</span>/<?= $post['imageCount'] ?>
                </span>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <button class="post__likes">
        <img class="post__like-icon" src="static/images/heart.png" alt="Сердечко">
        <?= $post['likes'] ?>
    </button>
    <?php if ($post['text'] !== ''): ?>
        <div class="post__text-block">
            <p class="post__text"><?= $post['text'] ?></p>
            <button class="post__more" type="button" hidden>Ещё</button>
        </div>
    <?php endif; ?>
    <span class="post__time"><?= timeOutput($post['time']) ?></span>
</div>