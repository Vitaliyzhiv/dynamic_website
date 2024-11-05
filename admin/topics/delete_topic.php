<?php
include '../../path.php';
include BASE_PATH . '/app/controllers/topics.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    
    $deleteTopic = deleteData($id, 'topics');

    if ($deleteTopic) {
        echo json_encode(['status' => 'success', 'message' => 'Категория была успешно удалена.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Не удалось удалить категорию.']);
    }
    exit();
}

