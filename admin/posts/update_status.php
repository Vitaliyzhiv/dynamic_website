<?php
include '../../path.php';
include BASE_PATH . '/app/controllers/posts.php';

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

