<?php


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dir = 'uploads';
    if (!is_dir($dir)) {
        mkdir($dir);
    }

    // Получение имени файла и его содержимого
    $file = $_FILES['user_avatar'];
    $filename = $file['name'];
    $tmp_name = $file['tmp_name'];
    $type = $file['type'];
    $size = $file['size'];

    // Проверка допустимости файла
    if ($file && isset($file['error']) && $file['error'] == UPLOAD_ERR_OK) {
        // Проверка расширения файла
        if (preg_match('/^image\/(jpeg|jpg|png)$/i', $type)) {
            if ($size <= 1048576) {
                // Сохранение файла
                $target_path = $dir.'/'.uniqid('img_', true).'_'.$filename;
                if (move_uploaded_file($tmp_name , $target_path)) {
                    echo "Файл успешно сохранен в {$target_path}";
                } else {
                    echo "Ошибка при сохранении файла!";
                }
            } else {
                echo "Изображение должно быть меньше 1 МБ";
            }

        } else {
            echo "Только JPEG, JPG или PNG файлы допускаются.";
        }
    } else {
        echo "невозможно загрузить файл!";
    }
}
?>