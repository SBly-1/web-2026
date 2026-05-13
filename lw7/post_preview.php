<div class="post">
    <div class="post__header">
        <img class="post__avatar" src="<?= $post['avatar'] ?>" 
            alt="аватар пользователя <?= $post['author'] ?>">
        <span class="post__author"><?= $post['author'] ?></span>
        <img class="post__edit" src="static/images/icon_edit.png" 
            alt="Редактировать">
    </div>
    <a class="post__media" href='post?postId=<?= $post['id'] ?>'>
        <img class="post__image" src="<?= $post['image'] ?>" 
            alt="<?= $post['imageAlt'] ?>">
        <?php if ($post['imageCount'] > 1): ?>
            <span class="post__image-count"><?= $post['imageNumber'] . '/' . $post['imageCount'] ?></span>
        <?php endif; ?>
        </a>
    <button class="post__likes">
        <img class="post__like-icon" src="static/images/heart.png" alt="Сердечко">
        <?= $post['likes'] ?>
    </button>
    <?php if ($post['text'] !== ''): ?>
        <p class="post__text"><?= $post['text'] ?></p>
        <span class="post__more">ещё</span>
    <?php endif; ?>
    <span class="post__time"><?= timeOutput($post['time']) ?></span>
</div>