<?php

include 'path.php';
include  BASE_PATH . '/app/database/db.php';
include BASE_PATH . '/app/include/header.php';

$post = selectOne('posts', ['id' => $_GET['post']]);
// tt($post);
$topics = selectAll('topics');

?>

<!-- Блок main -->
<div class="container">
    <div class="content row">
        <!-- Main content -->
        <div class="main-content col-md-9 col-12">
            <h2 class="single_post_title">
                <!-- Укорачиваем заголовок если он больше 120 символов -->
                <a href="<?php echo BASE_URL . 'single.php?post=' . $post['id']; ?>">
                    <?php echo $post['title']; ?>
                </a>
            </h2>
            <div class="single_post row">
                <div class="img col-12">
                    <?php $img = !(empty($post['img'])) ? $post['img'] : 'default_image.jpg'; ?>
                    <img src="<?php echo IMAGES_URL . 'posts/' . $img;  ?> " alt="<?php echo $post['title']; ?>" class="img-fluid">
                </div>
                <?php $author = selectOne('users', ['id' => $post['id_user']]);
                $author = $author['username'];
                ?>
                <div class="info">
                    <i class="far fa-user"></i> <span><?php echo $author; ?></span>
                    <?php $date = explode(' ', $post['created_date'])[0]; ?>
                    <i class="far fa-calendar"></i> <span><?php echo $date; ?></span>
                </div>

                <div class="single_post_text col-12 ">
                    <?php echo $post['content']; ?>
                </div>
            </div>
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
                <h3>Категории</h3>
                <ul>
                    <?php include BASE_PATH . '/app/include/sidebar-main.php';  ?>
                </ul>
            </div>

        </div>

        <!-- Sidebar end -->
    </div>
</div>

<!-- Блок main конец -->

<?php include 'app/include/footer.php'; ?>