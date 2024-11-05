<?php

include  BASE_PATH . '\app\database\db.php';

//  Отправка данных с формы в бд

$alertMsg = '';
$id = '';
$name = '';
$description = '';

// добавление категории
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $checkNameUnique = selectOne('topics', ['name' => $name]);
    $params = [
        'name' => $name,
        'description' => $description,
    ];

    if ($name == '') {
        $alertMsg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Введите имя категории!!!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                   </div>';
    } elseif (!empty($checkNameUnique)) {
        $alertMsg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Категория с таким именем уже существует!!!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                   </div>';
    } elseif (mb_strlen($name, 'UTF8') < 3) {
        $alertMsg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Имя категории должно быть более 2 символов!!!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                   </div>';
    } else {
        // Скидаємо `alertMsg` і додаємо категорію
        $alertMsg = '';
        $insertTopic = insert('topics', $params);
        if ($insertTopic) {
            // Відображення повідомлення про успішне додавання
            $alertMsg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Категория была успешно добавлена, вы будете перенаправлены на страницу всех категорий в течении 5 секунд.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            // echo $alertMsg;
            header("Location:" . BASE_URL . 'admin/topics/index.php');
            exit();
        } else {
            $alertMsg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                            Не удалось создать категорию.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
        }
    }
}



// редактирование категории 
// Получаем id категории из get параметра в url
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {

    $id = $_GET['id'];

    $topic = selectOne('topics', ['id' => $id]);

    $id = $topic['id'];
    $name = $topic['name'];
    $description = $topic['description'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {

    $id = $_POST['id'];
    tt($_POST['id']);
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $checkNameUnique = selectOne('topics', ['name' => $name]);
    $params = [
        'name' => $name,
        'description' => $description,
    ];

    if ($name == '') {
        $alertMsg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Введите имя категории!!!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                   </div>';
    } elseif (!empty($checkNameUnique)) {
        $alertMsg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Категория с таким именем уже существует!!!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                   </div>';
    } elseif (mb_strlen($name, 'UTF8') < 3) {
        $alertMsg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Имя категории должно быть более 2 символов!!!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                   </div>';
    } else {
        $alertMsg = '';
        $insertTopic = update($id, 'topics', $params);
        if ($insertTopic) {
            // Відображення повідомлення про успішне додавання
            $alertMsg = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Категория была успешно добавлена, вы будете перенаправлены на страницу всех категорий в течении 5 секунд.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
            // echo $alertMsg;
            header("Location:" . BASE_URL . 'admin/topics/index.php');
            exit();
        } else {
            $alertMsg = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                            Не удалось создать категорию.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>';
        }
    }
}

// удаление категории 
// // Получаем id категории из get параметра в url
// if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])) {

//     $id = $_GET['delete_id'];
//     tt($id);
//     $deleteTopic = deleteData($id, 'topics');
//     header("Location:". BASE_URL. 'admin/topics/index.php');

// }
