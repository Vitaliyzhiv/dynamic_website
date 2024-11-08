<?php
// Починаємо сесію

include '../../path.php';
include  BASE_PATH . '/app/controllers/users.php';
include BASE_PATH . '/app/include/header-admin.php';

?>

<div class="container">
    <div class="row">
        <?php include  BASE_PATH . '/app/include/sidebar-admin.php'; ?>
        <div class="posts col-9">
            <div class="button row m-3">
                <a href="create.php" class="col-2 btn btn-success">Добавить</a>
                <a href="<?php echo BASE_URL . 'admin/users/'; ?>" class="col-2 btn btn-primary">Управление</a>
            </div>
            <div class="row m-3 title-table">
                <h2 class="text-center">Пользователи</h2>
                <div class=" col-1"><strong>ID</strong></div>
                <div class=" col-2">Логин</div>
                <div class=" col-3">Email</div>
                <div class=" col-2">Роль</div>
                <div class=" col-2">Изменить</div>
                <div class=" col-2">Удалить</div>
            </div>
            <!-- Выводим каждого пользователя циклом -->
            <?php foreach ($users as $user): ?>
                <div class="row m-3 user">
                    <div class=" col-1"><?php echo $user['id']; ?></div>
                    <?php $role = $user['admin'] == 1 ? "Admin" : "User"; ?>
                    <div class=" col-2"><?php echo $user['username']; ?></div>
                    <div class="mail col-3"><?php echo $user['email']; ?></div>
                    <div class=" col-2"><?php echo $role; ?></div>
                    <div class=" col-2"><a href="edit.php?id=<?php echo $user['id']; ?>"><i class="fa fa-edit text-primary"></i></a></div>
                    <div class="delete-user col-2">
                        <a href="#" data-id="<?= $user['id'] ?>">
                            <i class="fa fa-trash text-danger"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>

<?php include BASE_PATH . '/app/include/footer.php'; ?>