<?php

// Дз добавить проверку на размер файла и так же проверку на ширину и высоту изображения.

include BASE_PATH . '\app\database\db.php';

if (!$_SESSION) {
    header('Location:' . BASE_URL . 'log.php');
}

$topics = selectAll('topics');
$posts = selectAll('posts');
$postsAdm = selectAllFromPostsWithUsers('posts', 'users');


$id = '';
$title = '';
$content = '';
$topicId = '';
$img = '';
$status = '';
$maxFileSize = 2 * 1024 * 1024;
$maxImageWidth = 1400;
$maxImageHeight = 800;
$titleMinLength = 7;
$errors = [];  // массив для сбора ошибок 

$errorsArray = [
    'incorrect_file_type' => ' тип файла не соответствует ожидаемому, загрузите пожалуйста изображение',
    'incorrect_size' => ' размер файла не соответствует ожидаемому: ' . $maxFileSize / (1024 * 1024) .  ' мб максимум',
    'empty_fields' => ' Заполните все поля',
    'upload_error' => ' загрузки файла на сервер',
    'file_get_error' => ' получения картинки',
    'add_post_error' => ' добавления поста',
    'update_post_error' => ' обновления поста',
    'img_properties_error' => ': размеры изображения не соответствуют ожидаемым (максимум ' . $maxImageWidth . 'x' . $maxImageHeight . ' пикселей)',
    'title_length_error' => ': длина заголовка должна быть больше ' . $titleMinLength . ' символов',
    'get_status_error' => 'возникла проблема с получением статуса публикации'
];

// добавление записи
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_post'])) {

    // Загрузка изображения 
    if (!empty($_FILES['img']['name'])) {
        $imgName = time() . '_' . $_FILES['img']['name'];
        $fileTmpName = $_FILES['img']['tmp_name'];
        $fileType = $_FILES['img']['type'];
        $destination = ROOT_PATH . "\assets\images\posts\\" . $imgName;
        $fileSize = $_FILES['img']['size'];

        // Проверка размера изображения 
        if ($fileSize > $maxFileSize) {
            $errors[] = $errorsArray['incorrect_size'];
        }

        // Размеры изображения ширина на высоту
        list($width, $height) = getimagesize($fileTmpName);

        // Проверка существует ли изображение и не превышает ли оно допустимых размеров
        if ($width === false || $height === false) {
            $errors[] = $errorsArray['file_get_error'];
        } else {
            if ($width > $maxImageWidth || $height > $maxImageHeight) {
                $errors[] = $errorsArray['img_properties_error'];
            }
        }

        // Проверяем тип файла
        if (strpos($fileType, 'image/') !== 0) {
            $errors[] = $errorsArray['incorrect_file_type'];
        }


        // если ошиьок нет перемещаем файл в конечную папку; 
        if (empty($errors)) {
            if (!move_uploaded_file($fileTmpName, $destination)) {
                $errors[] = $errorsArray['upload_error'];
            } else {
                $img = $imgName; // сохраняем имя изображения
            }
        }
    }

    $status = isset($_POST['publish']) ? 1 : 0;
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $idUser = $_SESSION['id'];
    $topicId = trim($_POST['topic']);

    // Проверяем, не пусты ли $title и $content;
    if ($title == '' || $content == '' || $topicId == '') {
        $errors[] = $errorsArray['empty_fields'];
    }

    // Перевірка довжини заголовка
    if (mb_strlen($title, 'UTF-8') < $titleMinLength) {
        $errors[] = $errorsArray['title_length_error'];
    }

    // Якщо помилок немає, вставляємо пост
    if (empty($errors)) {
        $post = [
            'title' => $title,
            'content' => $content,
            'id_user' => $idUser,
            'img' => $img,
            'topic_id' => $topicId,
            'status' => $status
        ];

        $insertPost = insert('posts', $post);
        if ($insertPost) {
            header("Location:" . BASE_URL . 'admin/posts/index.php');
        } else {
            $errors[] = $errorsArray['add_post_error'];
        }
    }

    // // Выводим сообщение об х, если они есть
    // if (!empty($errors)) {
    //     $alertMsg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    //     $alertMsg .= implode('<br>', $errors);
    //     $alertMsg .= '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    //     $alertMsg .= '</div>';
    // }
}

// Изменение записи: 

// Получаем данные про категорию с get запроса для последующей обработки
// редактирование категории 
// Получаем id категории из get параметра в url
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {

    $id = $_GET['id'];
    $post = selectOne('posts', ['id' => $id]);
    $id = $post['id'];
    $title = $post['title'];
    $content = $post['content'];
    $topicId = $post['topic_id'];
    $img = $post['img'];
    $status = $post['status'];
}



// Обновление записи

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {

    // переменные  с пост запроса
    $id = $_POST['id'];
    // Снова получаем данные текущего поста
    $post = selectOne('posts', ['id' => $id]);
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $topicId = trim($_POST['topic']);
    $idUser = $_SESSION['id'];

    if (!empty($_FILES['img']['name'])) {
        $imgName = time() . '_' . $_FILES['img']['name'];
        $fileTmpName = $_FILES['img']['tmp_name'];
        $fileType = $_FILES['img']['type'];
        $destination = ROOT_PATH . "\assets\images\posts\\" . $imgName;
        $fileSize = $_FILES['img']['size'];

        // Проверка размера изображения 
        if ($fileSize > $maxFileSize) {
            $errors[] = $errorsArray['incorrect_size'];
        }

        // Размеры изображения ширина на высоту
        list($width, $height) = getimagesize($fileTmpName);

        // Проверка существует ли изображение и не превышает ли оно допустимых размеров
        if ($width === false || $height === false) {
            $errors[] = $errorsArray['file_get_error'];
        } else {
            if ($width > $maxImageWidth || $height > $maxImageHeight) {
                $errors[] = $errorsArray['img_properties_error'];
            }
        }

        // Проверяем тип файла
        if (strpos($fileType, 'image/') !== 0) {
            $errors[] = $errorsArray['incorrect_file_type'];
        }


        // если ошибок нет перемещаем файл в конечную папку; 
        if (empty($errors)) {
            if (!move_uploaded_file($fileTmpName, $destination)) {
                $errors[] = $errorsArray['upload_error'];
            } else {
                $img = $imgName; // Зберігаємо ім'я зображення
            }
        }
    }

    // Если в форму прилетает publish , значит на данный момент статус установлен в false, поэтому при 
    // публикации изменяем его на 1, в противном случае если прилетает unpublish значит мы снимаем с ..
    // публикации
    if (isset($_POST['publish'])) {
        $status = 1;
    } elseif (isset($_POST['unpublish'])) {
        $status = 0;
    } else {
        $status = $post['status'];
    }

    // Проверяем пуст ли $status 
    if ($status == '') {
        $errors[] = $errorsArray['get_status_error'];
    }

    // Проверяем, не пусты ли $title и $content;
    if ($title == '' || $content == '' || $topicId == '') {
        $errors[] = $errorsArray['empty_fields'];
    }

    //  Проверка длины заголовка
    if (mb_strlen($title, 'UTF-8') < $titleMinLength) {
        $errors[] = $errorsArray['title_length_error'];
    }

    //  Если нет ошибок обновляем пост
    if (empty($errors)) {
        $post = [
            'title' => $title,
            'content' => $content,
            'id_user' => $idUser,
            'img' => $img,
            'topic_id' => $topicId,
            'status' => $status
        ];

        $updatePost = update($id, 'posts', $post);
        if ($updatePost) {
            header("Location:" . BASE_URL . 'admin/posts/index.php');
        } else {
            $errors[] = $errorsArray['update_post_error'];
        }
    }
}

// изменение статуса используя аякс
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_status']) && isset($_POST['update_id'])) {

    $id = $_POST['update_id'];

    $params = [
        'status' => $_POST['new_status']
    ];

    $updateStatus = update($id,  'posts', $params );

    if ($updateStatus) {
        echo json_encode(['status' => 'success', 'message' => 'Статус был успешно изменен.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Не удалось изменить статус.']);
    }
    exit();

}