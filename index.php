<?php
// Починаємо сесію

include 'path.php';
include  BASE_PATH . '/app/controllers/users.php';
include BASE_PATH . '/app/include/header.php';

$topics = selectAll('topics');
$posts = selectAll('posts');
$users = selectAll('users');
$postsAdm = selectAllFromPostsWithUsers('posts', 'users');

$selectPostsSlider = selectAll('posts', [
    'status' => 1,
    'topic_id' => 16
]);


?>

<!-- блок карусели -->
<div class="container">
    <div class="row">
        <h2 class="slider-title p-3 text-center">Топ посты</h2>
    </div>
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
        <div class="carousel-inner">
            <?php for ($i = 0; $i < count($selectPostsSlider); $i++):
                $slider = $selectPostsSlider[$i];
                $activeClass = ($i === 0) ? 'active' : '';
                $img = !(empty($slider['img'])) ? $slider['img'] : 'default_image.jpg';
            ?>
                <div class="carousel-item <?= $activeClass ?>">
                    <img src="<?= IMAGES_URL . 'posts/' . $img; ?>" class="d-block w-100" alt="<?= $slider['title']; ?>">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>
                            <a href="<?php echo BASE_URL . 'single.php?post=' . $slider['id']; ?>">
                                <?= $slider['title']; ?>
                            </a>
                        </h5>
                    </div> <!-- carousel-caption -->
                </div> <!-- carousel-item -->
            <?php endfor; ?>
        </div> <!--  carousel-inner -->

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div> <!-- Закриваючий тег для carousel -->

    <!-- блок карусели конец -->

    <!-- Блок main -->
    <div class="container">
        <div class="content row">
            <!-- Main content -->
            <div class="main-content col-md-9 col-12">
                <h2>Последние публикации</h2>
                <!-- Проходимся циклом по всем постам в массиве postsAdm  -->
                <?php foreach ($postsAdm as $post): ?>
                    <!-- Выводим пост  если его статус равен 1 -->
                    <?php if ($post['status'] == 1): ?>
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