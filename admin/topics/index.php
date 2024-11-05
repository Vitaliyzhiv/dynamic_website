<?php
// Починаємо сесію

include '../../path.php';
include  BASE_PATH . '/app/controllers/topics.php';
include BASE_PATH . '/app/include/header-admin.php';

?>

<div class="container">
    <div class="row">
        <?php include BASE_PATH . '/app/include/sidebar-admin.php'; ?>
        <div class="posts col-9">
            <div class="button row m-3">
                <a href="create.php" class="col-2 btn btn-success">Создать </a>
                <a href="index.php" class="col-2 btn btn-primary">Управление</a>
            </div>
            <div class="row m-3 title-table">
                <h2 class="text-center">Управление категориями</h2>
                <div class="id col-1"><strong>ID</strong></div>
                <div class="title col-5">Название категории</div>
                <div class="actions col-3">Изменить</div>
                <div class="delete col-3">Удалить</div>
            </div>
            <!-- Получаем список названий всех категорий -->
            <?php $topics = selectAll('topics');
            // Выводим категории листингом  -->
            foreach ($topics as $topic) : ?>
                <div class="row m-3 post">
                    <div class="id col-1"><?= $topic['id'] ?></div>
                    <div class="title col-5"><?= $topic['name'] ?></div>
                    <div class="actions col-3"><a href="edit.php?id=<?= $topic['id'] ?>"><i class="fa fa-edit text-primary"></i></a></div>
                    <div class="delete-category col-3">
                        <a href="#" data-id="<?= $topic['id'] ?>">
                            <i class="fa fa-trash text-danger"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>

<?php include BASE_PATH . '/app/include/footer.php'; ?>