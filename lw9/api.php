<?php
header('Content-Type: application/json; charset=utf-8');

function checkImageResolution(string $fileName): string {
    $fileResolution = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if ($fileResolution !== 'png' && $fileResolution !== 'jpg' && $fileResolution !== 'jpeg' && $fileResolution !== 'webp') {
        return '';
    }
    if ($fileResolution === 'jpeg') {
        return 'jpg';
    }
    return $fileResolution;
}

function createImageName(string $fileResolution): string {
    return 'post_' . time() . '_' . rand(1000, 9999) . '.' . $fileResolution;
}

function connectDatabase(): PDO {
    $dsn = 'mysql:host=127.0.0.1;dbname=blog;charset=utf8mb4';
    $user = 'root';
    $password = '';
    return new PDO($dsn, $user, $password);
}

function savePostToDatabase(PDO $connection, int $userId, string $content): int {
    $query = "
        INSERT INTO post (user_id, content, created_at)
        VALUES ('$userId', '$content', NOW())
    ";
    $connection->exec($query);
    return (int)$connection->lastInsertId();
}

function savePostImageToDatabase(PDO $connection, int $postId, string $imageUrl, string $imageAlt, int $imageNumber): void {
    $query = "
        INSERT INTO post_image (post_id, image_url, image_alt, image_number)
        VALUES ('$postId', '$imageUrl', '$imageAlt', '$imageNumber')
    ";
    $connection->exec($query);
}

$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'POST') {
    if (!isset($_POST['post'])) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Нет данных поста'
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }
    $json = $_POST['post'];
    $data = json_decode($json, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Ошибка JSON: ' . json_last_error_msg()
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    if (!isset($data['userId']) || trim((string)$data['userId']) === '') {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Не передан userId'
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    if (!is_numeric($data['userId'])) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'userId должен быть числом'
        ], JSON_UNESCAPED_UNICODE);
        exit;    
    }
    $userId = (int)$data['userId'];

    if ($userId <= 0) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'userId некорректный'
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $content = null;
    if (!isset($data['content']) || trim($data['content']) === '') {
        echo json_encode([
            'success' => false,
            'message' => 'Текст поста не передан'
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }
    $content = trim($data['content']);
    
    $imageAlt = 'Изображение поста';
    if (isset($data['imageAlt']) && trim($data['imageAlt']) !== '') {
        $imageAlt = trim($data['imageAlt']);
    }

    if (!isset($_FILES['images'])) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Картинка не передаётся'
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $imageFolder = __DIR__ . '/static/images/';
    $savedImages = [];
    $imageCount = count($_FILES['images']['name']);

    if ($imageCount > 10) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Можно загрузить не больше 10 картинок'
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    if ($imageCount === 0) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Картинки не передаются'
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }

    for ($i = 0; $i < $imageCount; $i++) {
        if ($_FILES['images']['error'][$i] !== UPLOAD_ERR_OK) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'Ошбка загрузки картинки'
            ], JSON_UNESCAPED_UNICODE);
            exit;
        }

        $fileResolution = checkImageResolution($_FILES['images']['name'][$i]);
        if ($fileResolution === '') {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'Рвзрешение файла не корректное'
            ], JSON_UNESCAPED_UNICODE);
            exit;
        }

        $imageName = createImageName($fileResolution);
        $imagePath = $imageFolder . $imageName;

        if (!move_uploaded_file($_FILES['images']['tmp_name'][$i], $imagePath)) {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Не удалось сохранить картинку'
            ], JSON_UNESCAPED_UNICODE);
            exit;
        }
        $imageUrl = 'static/images/' . $imageName;
        $savedImages[] = $imageUrl;
    }
    try {
        $connection = connectDatabase();
        $postId = savePostToDatabase($connection, $userId, $content);
        for ($i = 0; $i < count($savedImages); $i++) {
            savePostImageToDatabase($connection, $postId, $savedImages[$i], $imageAlt, $i + 1);
        }
        http_response_code(201);
        echo json_encode([
            'success' => true,
            'message' => 'Пост успешно сохранён'
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }
    catch (Throwable $error) {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Ошибка базы данных'
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }
}
else {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Метод не поддерживается'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}
?>