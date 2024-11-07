<?php
// Починаємо сесію

include '../../path.php';
include  BASE_PATH . '/app/controllers/posts.php';
include BASE_PATH . '/app/include/header-admin.php';

?>



<div class="container">
    <div class="row">
        <?php include  BASE_PATH . '/app/include/sidebar-admin.php'; ?>
        <div class="posts col-9">
            <div class="button row m-3">
                <a href="create.php" class="col-2 btn btn-success">Создать</a>
                <a href="index.php" class="col-2 btn btn-primary">Управлять</a>
            </div>
            <div class="row m-3 title-table">
                <h2 class="text-center">Добавление записи</h2>
            </div>
            <div class="row m-3 add-post">
                <!-- Форма добавления поста -->
                <!-- Multipart/form-data используется для подгрузки файлов на сервер и хранении их во временной папке -->
                <form action="create.php" method="post" enctype="multipart/form-data">
                    <?php //if ($alertMsg !== ''): ?>
                        <?//= $alertMsg ?>
                    <?php //endif; ?>
                    <?php include BASE_PATH . '/app/helps/errorsinfo.php';?>
                    <div class="col mb-3">
                        <input type="text" value="<?= $title ?>" name="title" class="form-control" placeholder="Title..." aria-label="Название статьи">
                    </div>
                    <div class="col mb-3">
                        <label for="content" class="form-label">Содержимое записи</label>
                        <textarea name="content" class="form-control" id="content" rows="6">
                            <?= $content ?> 
                        </textarea>
                    </div>
                    <div class="input-group col mb-3">
                        <input name="img" type="file" class="form-control" id="inputGroupFile02">
                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                    </div>
                    <label for="topic" class="mb-1">Выберите категорию поста: </label>
                    <select name="topic" class="form-select mb-3" aria-label="Default select example">
                        <?php foreach ($topics as $topic): ?>
                            <!-- Выводим option -->
                            <option value="<?php echo $topic['id']; ?>"><?php echo $topic['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="form-check mb-2">
                        <input class="form-check-input" value="1" checked name="publish" type="checkbox" style="width: 16px; height: 16px; border: 2px solid #007bff; border-radius: 4px;">
                        <label class="form-check-label pt-1 ms-2" for="flexCheckChecked">
                            Publish
                        </label>
                    </div>
                    <div class="col">
                        <button name="add_post" type="submit" class="btn btn-primary mb-3">Добавить запись</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<?php include BASE_PATH . '/app/include/footer.php'; ?>