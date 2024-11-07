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
            <div class="row m-3 title-table">
                <h2 class="text-center">Изменение записи </h2>
            </div>
            <div class="row m-3 add-post">
                <!-- Форма добавления поста -->
                <!-- Multipart/form-data используется для подгрузки файлов на сервер и хранении их во временной папке -->
                <form action="edit.php" method="post" enctype="multipart/form-data">
                    <?php //if ($alertMsg !== ''): 
                    ?>
                    <? //= $alertMsg 
                    ?>
                    <?php //endif; 
                    ?>
                    <?php include BASE_PATH . '/app/helps/errorsinfo.php'; ?>
                    <div class="col mb-3">
                        <input type="hidden" value="<?php echo $id; ?>" name="id">
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
                            <!-- Выводим option с условием для selected -->
                            <option value="<?php echo $topic['id']; ?>"
                                <?php echo ($topic['id'] == $topicId) ? 'selected' : ''; ?>>
                                <?php echo $topic['name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="form-check mb-2">
                        <!-- Пишем проверку для вывода текущего состояния записи -->
                        <?php if (empty($status) || $status == 0): ?>
                            <input class="form-check-input" value="0" name="publish" type="checkbox" style="width: 16px; height: 16px; border: 2px solid #007bff; border-radius: 4px;">
                            <label class="form-check-label pt-1 ms-2" for="flexCheckChecked">
                                Publish
                            </label>
                        <?php else: ?>
                            <input class="form-check-input" value="1" name="unpublish" type="checkbox" style="width: 16px; height: 16px; border: 2px solid #007bff; border-radius: 4px;">
                            <label class="form-check-label pt-1 ms-2" for="flexCheckChecked">
                               Unpublish
                            </label>
                        <?php endif; ?>
                    </div>
                    <div class="col">
                        <button name="update" type="submit" class="btn btn-primary mb-3">Изменить запись</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<?php include BASE_PATH . '/app/include/footer.php'; ?>