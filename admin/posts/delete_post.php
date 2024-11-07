<?php
include '../../path.php';
include BASE_PATH . '/app/controllers/posts.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    
    $deletePost = deleteData($id, 'posts');

    if ($deletePost) {
        echo json_encode(['status' => 'success', 'message' => 'Запись была успешно удалена.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Не удалось удалить запись.']);
    }
    exit();
}
