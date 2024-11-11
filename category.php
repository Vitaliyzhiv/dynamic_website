<?php
// Починаємо сесію

include 'path.php';
include  BASE_PATH . '/app/database/db.php';
include BASE_PATH . '/app/include/header.php';

// Получаем id категории через GET-параметр
if (isset($_GET['topic_id'])) {
    $category_id = $_GET['topic_id'];
    $category = selectOne('topics', ['id' => $category_id]);
    // Название категории
    $title = $category['name'];
    // Получаем все посты которые относятся к данной категории
    $posts = selectAll('posts', ['topic_id' => $category_id]);
};


// Категории для вывода в сайдбар
$topics = selectAll('topics');



?>

<!-- блок карусели -->
<div class="container">
    <div class="row">
        <h2 class="slider-title p-3 text-center">Топ посты</h2>
    </div>
    <!-- блок карусели конец -->

    <!-- Блок main -->
    <div class="container">
        <div class="content row">
            <!-- Main content -->
            <div class="main-content col-md-9 col-12">
                <h2>Посты из категории <strong><?php echo $title; ?></strong></h2>


                <!-- Проверяем пустой ли массив, если он пустой выводим сообщение в данной категории пока нет постов -->
                <?php if (empty($posts)): ?>
                    <p class="text-center alert alert-danger">В данной категории пока нет постов.</p>
                    <!-- Ссылка на главную кнокой -->
                    <div class="col">

                        <a href="<?php echo BASE_URL; ?>" class="w-100 btn btn-primary">На главную</a>
                    </div>
                <?php else: ?>
                    <!-- Проходимся циклом по всем постам в массиве postsAdm  -->
                    <?php foreach ($posts as $post): ?>
                        <!-- Выводим пост  если его статус равен 1 -->
                        <?php if ($post['status'] == 1 && $post): ?>
                            <div class="post row">
                                <div class="img col-12 col-md-4">
                                    <?php $img = !(empty($post['img'])) ? $post['img'] : 'default_image.jpg'; ?>
                                    <img src="<?php echo IMAGES_URL . 'posts/' . $img;  ?> " alt="<?php echo $post['title']; ?>" class="img-thumbnail">
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
                                    <!-- Получаем автора статьи -->
                                    <?php $author = selectOne('users', ['id' => $post['id_user']]);
                                    $author = $author['username'];
                                    ?>
                                    <i class="far fa-user"></i> <span><?php echo $author; ?></span>
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
                <?php endif; ?>
            </div>
            <!-- Main content end -->

            <!-- Sidebar -->
            <div class="sidebar col-12 col-md-3">

                <div class="section search">
                    <h3>Поиск</h3>
                    <form action="search.php" method="post">
                        <input type="text" name="search-term" class="text-input" placeholder="Введите поисковый запрос...">
                    </form>
                </div>

                <div class="section topics">
                    <h3 style="color: #006969;">Категории</h3>
                    <ul>
                        <?php include BASE_PATH . '/app/include/sidebar-main.php';  ?>
                    </ul>
                </div>

            </div>

            <!-- Sidebar end -->
        </div>
    </div>

    <!-- Блок main конец -->

    <?php include BASE_PATH . '/app/include/footer.php'; ?>