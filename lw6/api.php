<?php

function readFileName(string $data): string {
    $fileName = '';
    $chars = str_split($data);
    foreach ($chars as $char) {
        if (!ctype_alnum($char) && $char !== '_' && $char !== '-' && $char !== '.') {
            return '';
        }
        else {
            $fileName = $fileName . $char;
        }
    }
    $count = 0;
    $chars = str_split($fileName);
    foreach ($chars as $char) {
        if ($char === '.') {
            $count++;
        }
    }
    if ($count > 1) {
        return '';
    }
    return $fileName;
}

function separateFileResolution(string $data): string {
    $fileResolution = '';
    $beginResolution = false;
    $chars = str_split($data);
    foreach ($chars as $char) {
        if ($beginResolution) {
            $fileResolution = $fileResolution . $char;   
        }
        if ($char === '.') {
            $beginResolution = true;
        }
    }
    if ($beginResolution === false) {
        return 'png';
    }
    $fileResolution = strtolower($fileResolution);
    if ($fileResolution !== 'png' && $fileResolution !== 'jpg' && $fileResolution !== 'jpeg' && $fileResolution !== 'webp') {
        return '';
    }
    return $fileResolution;
}

function separateFileName(string $data): string {
    $fileName = '';
    $chars = str_split($data);
    foreach ($chars as $char) {
        if ($char === '.') {
            return $fileName;
        }
        $fileName = $fileName . $char;
    }
    return $fileName;
}

$method = $_SERVER['REQUEST_METHOD'];
if ($method === 'POST') {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400);
        echo 'Ошибка JSON: ' . json_last_error_msg();
        exit;
    }
    if (isset($data['fileName']) && isset($data['image']) && $data['fileName'] !== '' && $data['image'] !== ''){
        $fileName = readFileName(trim($data['fileName']));
        if ($fileName === '') {
            http_response_code(400);
            echo 'имя файла не корректно';
            exit;
        }
        $fileResolution = separateFileResolution($fileName);
        if ($fileResolution === '') {
            http_response_code(400);
            echo 'разрешение файла не корректно';
            exit;
        }
        $fileName = separateFileName($fileName);
        if ($fileName === '') {
            http_response_code(400);
            echo 'имя файла не корректно';
            exit;
        }
        $image = $data['image'];
        $parts = explode('base64,', $image);
        if (isset($parts[1])) {
            $image = $parts[1]; 
        }
        else {
            $image = $parts[0];
        }

        $imageData = base64_decode(trim($image), true);
        if ($imageData === false) {
            http_response_code(400);
            echo 'Картинка повреждена или base64 некорректный';
            exit;
        }

        $filePath = __DIR__ . '/static/images/' . $fileName . '.' . $fileResolution;
        if (file_put_contents($filePath, $imageData) === false) {
            http_response_code(500);
            echo 'Не удалось сохранить файл';
            exit;
        }

        http_response_code(201);
        echo 'Файл успешно сохранён';
    }
    else {
        http_response_code(400);
        echo 'Нет нужных полей';
        exit;
    }
}
else {
    http_response_code(405);
    echo 'Метод не поддерживается';
    exit;
}
?>