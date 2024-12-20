<?php


include '../../path.php';
include  BASE_PATH . '/app/controllers/topics.php';
include BASE_PATH . '/app/include/header-admin.php';

?>

<div class="container">
    <div class="row">
        <?php include  BASE_PATH . '/app/include/sidebar-admin.php'; ?>
        <div class="posts col-9">
            <div class="button row m-3">
                <a href="create.php" class="col-2 btn btn-success">Создать</a>
                <a href="index.php" class="col-2 btn btn-primary">Управление</a>
            </div>
            <div class="row m-3 title-table">
                <h2 class="text-center">Создать категорию</h2>
            </div>
            <div class="row m-3 add-post">
                <!-- Форма добавления поста -->
                <form action="create.php" method="post">
                    <?php include BASE_PATH . '/app/helps/errorsinfo.php'; ?>
                    <div class="col mb-2">
                        <input type="text" value="<?= htmlspecialchars($name) ?>" name="name" class="form-control" placeholder="Название категории..." aria-label="Название категории..">
                    </div>
                    <div class="col mb-2">
                        <label for="content" class="form-label">Описание категории</label>
                        <textarea name="description" class="form-control" id="content" rows="6"><?= htmlspecialchars($description) ?></textarea>
                    </div>
                    <div class="col">
                        <button type="submit" name="submit" class="btn btn-primary mb-3">Создать категорию</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>

<?php include BASE_PATH . '/app/include/footer.php'; ?>