<?php

include  BASE_PATH . '\app\database\db.php';

// ДЗ сделать вывод ошибок в массив.

$alertMsg = '';
$id = '';
$name = '';
$description = '';
// Мінімальна довжина заголовка
$titleMinLength = 2;
// массив для сбора ошибок
$errors = [];




$errorsArray = [
    'empty_fields_error' => 'заполните все поля',
    'title_length_error' => 'длина заголовка должна быть более ' . $titleMinLength . ' символов',
    'category_name_unique_error' => 'такая категория уже существует!',
    'add_category_error' => 'не удалось добавить категорию категории!',
    'empty_category_name_error' => 'имя категории не может быть пустым',
    'category_update_error' => 'не удалось обновить категорию'
];

// добавление категории
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $checkNameUnique = selectOne('topics', ['name' => $name]);
    $params = [
        'name' => $name,
        'description' => $description,
    ];

    // Проверка на заполненость поля имя категории
    if ($name == '') { 
        $errors[] = $errorsArray['empty_category_name_error'];
    }

    // Проверка на минимальную длину имени категории
    if (mb_strlen($name, 'UTF8') < $titleMinLength) {
        $errors[] = $errorsArray['title_length_error'];
    }

    // Проверка на наличие уникальности имени категории
    if (!empty($checkNameUnique)) {
        $errors[] = $errorsArray['category_name_unique_error'];
    }

    // Если массив ошибок пуст то вставляем категорию в бд 
    if (empty($errors)) { 
        $insertTopic = insert('topics', $params);
        if ($insertTopic) {
            header("Location:". BASE_URL. 'admin/topics/index.php');
            exit();
        } else {
            $errors[] = $errorsArray['add_category_error'];
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
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $checkNameUnique = selectOne('topics', ['name' => $name]);
    $params = [
        'name' => $name,
        'description' => $description,
    ];

    // Проверка на заполненость поля имя категории
    if ($name == '') { 
        $errors[] = $errorsArray['empty_category_name_error'];
    }

    // Проверка на минимальную длину имени категории
    if (mb_strlen($name, 'UTF8') < $titleMinLength) {
        $errors[] = $errorsArray['title_length_error'];
    }

    // Проверка на наличие уникальности имени категории
    if (!empty($checkNameUnique)) {
        $errors[] = $errorsArray['category_name_unique_error'];
    }

    // Если массив ошибок пуст то редактируем категорию в бд
    if (empty($errors)) {
        $updateTopic = update($id, 'topics', $params);
        if ($updateTopic) {
            header("Location:". BASE_URL. 'admin/topics/index.php');
            exit();
        } else {
            $errors[] = $errorsArray['category_update_error'];
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
