<?php

include 'db.php';

function findPostsInDatabase(PDO $connection): array
{
    $query = <<<SQL
        SELECT
            post.id,
            post.likes,
            post.content,
            UNIX_TIMESTAMP(post.created_at) AS created_at,
            user.user_name,
            user.avatar_url,
            post_image.image_url,
            post_image.image_alt,
            post_image.image_number,
            COUNT(post_image.id) OVER (PARTITION BY post.id) AS image_count
        FROM post
        JOIN user ON post.user_id = user.id
        LEFT JOIN post_image ON post.id = post_image.post_id
        ORDER BY post.created_at DESC, post_image.image_number
        SQL;

    $statement = $connection->query($query);
    return $statement->fetchAll();
}

$connection = connectDatabase();
$postsFromDatabase = findPostsInDatabase($connection);

$posts = [];

foreach ($postsFromDatabase as $postFromDatabase) {
    $postId = (int)$postFromDatabase['id'];

    if (!isset($posts[$postId])) {
        $posts[$postId] = [
            'id' => $postId,
            'avatar' => $postFromDatabase['avatar_url'],
            'author' => $postFromDatabase['user_name'],
            'likes' => (int)$postFromDatabase['likes'],
            'text' => $postFromDatabase['content'] ?? '',
            'time' => (int)$postFromDatabase['created_at'],
            'image' => '',
            'imageAlt' => '',
            'imageNumber' => '',
            'imageCount' => (int)$postFromDatabase['image_count'],
            'images' => [],
        ];
    }

    if ($postFromDatabase['image_url'] !== null) {
        $image = [
            'url' => $postFromDatabase['image_url'],
            'alt' => $postFromDatabase['image_alt'] ?? '',
            'number' => (int)$postFromDatabase['image_number'],
        ];

        $posts[$postId]['images'][] = $image;

        if ($posts[$postId]['image'] === '') {
            $posts[$postId]['image'] = $image['url'];
            $posts[$postId]['imageAlt'] = $image['alt'];
            $posts[$postId]['imageNumber'] = $image['number'];
        }
    }
}

$posts = array_values($posts);