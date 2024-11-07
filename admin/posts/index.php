<?php

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
                <h2 class="text-center">Управление записями</h2>
                <div class="id col-1"><strong>ID</strong></div>
                <div class="title col-3">Название</div>
                <div class="author col-2">Автор</div>
                <div class="actions text-center col-2">Изменить</div>
                <div class="delete text-center col-2">Удалить</div>
                <div class="status text-center col-2"> Статус </div>
            </div>
            <?php foreach ($postsAdm as $post): ?>
                <div class="row m-3 post">
                    <div class="id col-1"><?php echo $post['id']; ?></div>
                    <div class="title col-3"><?php echo $post['title']; ?></div>
                    <?php //$author = selectOne('users', ['id' => $post['id_user']]);
                    //$author_name = $author['username'];
                    ?>
                    <div class="author col-2"><?php echo $post['username']; ?></div>
                    <div class="actions text-center col-2"><a href="edit.php?id=<?php echo $post['id']; ?>"><i class="fa fa-edit text-primary"></i></a></div>
                    <div class="delete-post text-center col-2">
                        <a href="#" data-id="<?php echo $post['id'] ?>">
                            <i class="fa fa-trash text-danger"></i>
                        </a>
                    </div>
                    <?php $text_status = $post['status'] == 1 ? "В черновик" : "Опубликовать"; ?>
                    <div class="post-status col-2">
                        <a href="#" data-id="<?php echo $post['id'] ?>" data-status="<?php echo $post['status'] ?>">
                        <?php echo $text_status; ?>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>

<?php include BASE_PATH . '/app/include/footer.php'; ?>