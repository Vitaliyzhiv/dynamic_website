<?php
// Починаємо сесію

include 'path.php';
include  BASE_PATH . '/app/database/db.php';
include BASE_PATH . '/app/include/header.php';

// Получаем посты по ключевому слову
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search-term'])) {
    $postsAdm = searchInTitleandContent($_POST['search-term'], 'posts', 'users');
}
?>

<!-- Блок main -->
<div class="container">
    <div class="content row">
        <!-- Main content -->
        <div class="main-content col-12">
            <h2>Результаты поиска</h2>
            <!-- Проходимся циклом по всем постам в массиве postsAdm -->
            <!-- если поиск является пустым массивом, выводим блок с sidebar в части else  -->
            <?php if (!empty($postsAdm)): ?>
                <?php foreach ($postsAdm as $post): ?>
                    <!-- Выводим пост если его статус равен 1 -->
                    <?php if ($post['status'] == 1): ?>
                        <div class="post row">
                            <div class="img col-12 col-md-4">
                                <?php $img = !(empty($post['img'])) ? $post['img'] : 'default_image.jpg'; ?>
                                <img src="<?php echo IMAGES_URL . 'posts/' . $img; ?>" alt="<?php echo $post['title']; ?>" class="img-thumbnail">
                            </div>
                            <div class="post_text col-12 col-md-8">
                                <h3>
                                    <!-- Укорачиваем заголовок если он больше 120 символов -->
                                    <?php if (strlen($post['title']) > 120): ?>
                                        <a href="<?php echo BASE_URL . 'single.php?id=' . $post['id']; ?>">
                                            <?php echo substr($post['title'], 0, 120) . '...'; ?>
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo BASE_URL . 'single.php?post=' . $post['id']; ?>">
                                            <?php echo $post['title']; ?>
                                        </a>
                                    <?php endif; ?>
                                </h3>
                                <i class="far fa-user"></i> <span><?php echo $post['username']; ?></span>
                                <?php $date = explode(' ', $post['created_date'])[0]; ?>
                                <i class="far fa-calendar"></i> <span><?php echo $date; ?></span>
                                <?php if (mb_strlen($post['content'], 'UTF-8') > 200): ?>
                                    <?php echo mb_substr($post['content'], 0, 200, 'UTF-8') . '...'; ?>
                                <?php else: ?>
                                    <?php echo $post['content']; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <h3 class="text-center"><strong>Ничего не найдено</strong></h3>
                <div class="sidebar col-12 mb-4 ">
                    <div class="section bg-dark-subtle p-4 rounded shadow">
                        <h3 class="text-center mb-3">Поиск</h3>
                        <form action="search.php" method="post" class="d-flex justify-content-center">
                            <input type="text" name="search-term" class="form-control me-2" placeholder="Введите поисковый запрос...">
                        </form>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <!-- Main content end -->
    </div>
</div>
<!-- Блок main конец -->

<?php include BASE_PATH . '/app/include/footer.php'; ?>