<?php
include '../../path.php';
include BASE_PATH . '/app/controllers/users.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];

    if ($id == $_SESSION['id']) {
        echo json_encode(['status' => 'error', 'message' => 'Пользователь не может удалять сам себя.']);
        exit();
    }

    $deleteUser = deleteData($id, 'users');

    if ($deleteUser) {
        echo json_encode(['status' => 'success', 'message' => 'Пользователь был успешно удален.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Не удалось удалить пользователя.']);
    }
    exit();
}
