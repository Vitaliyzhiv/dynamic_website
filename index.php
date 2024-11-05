<?php 
// Починаємо сесію

include 'path.php'; 
include  BASE_PATH . '/app/controllers/users.php';
include BASE_PATH . '/app/include/header.php'; 

$topics = selectAll('topics');

?>

    <!-- блок карусели -->
    <div class="container">
        <div class="row">
            <h2 class="slider-title p-3 text-center">Топ посты</h2>
        </div>
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
            <div class="carousel-inner">
                <?php
                // создаем массив с id  изображений
                $images = [87, 88, 89, 90, 91];
                $slides = count($images); // Количество слайдов

                $slide_links = [
                    'article1.php',
                    'article2.php',
                    'article3.php',
                    'article4.php',
                    'article5.php',
                ];

                for ($i = 0; $i < $slides; $i++):
                    // Добавляем класс active к первому слайду.
                    $activeClass = ($i === 0) ? 'active' : '';
                    $imageSrc = "https://picsum.photos/id/{$images[$i]}/800/400";
                ?>
                    <div class="carousel-item <?= $activeClass ?>">
                        <img src="<?= $imageSrc ?>" class="d-block w-100" alt="Slide <?= $i + 1 ?>">
                        <div class="carousel-caption d-none d-md-block">
                            <h5><a href="<?= $slide_links[$i] ?>">Slide <?= $i + 1 ?> label</a></h5>
                        </div>
                    </div>
                <?php endfor; ?>

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- блок карусели конец -->

    <!-- Блок main -->
    <div class="container">
        <div class="content row">
            <!-- Main content -->
            <div class="main-content col-md-9 col-12">
                <h2>Последние публикации</h2>
                <div class="post row">
                    <div class="img col-12 col-md-4">
                        <img src="https://picsum.photos/id/237/200" alt="" class="img-thumbnail">
                    </div>
                    <div class="post_text col-12 col-md-8">
                        <h3>
                            <a href="#">Прикольная статья на тему динамического сайта</a>
                        </h3>
                        <i class="far fa-user"></i> <span>Имя автора</span>
                        <i class="far fa-calendar"></i> <span>July 12 2006</span>

                        <p class="preview-text">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nisi cupiditate architecto aliquam recusandae eius, hic rem beatae atque. Enim minima pariatur molestiae saepe officiis reprehenderit molestias veritatis sed beatae aliquid.
                        </p>
                    </div>
                </div>
                <div class="post row">
                    <div class="img col-12 col-md-4">
                        <img src="https://picsum.photos/id/421/200" alt="" class="img-thumbnail">
                    </div>
                    <div class="post_text col-12 col-md-8">
                        <h3>
                            <a href="#">Прикольная статья на тему динамического сайта</a>
                        </h3>
                        <i class="far fa-user"></i> <span>Имя автора</span>
                        <i class="far fa-calendar"></i> <span>July 12 2006</span>

                        <p class="preview-text">
                            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nisi cupiditate architecto aliquam recusandae eius, hic rem beatae atque. Enim minima pariatur molestiae saepe officiis reprehenderit molestias veritatis sed beatae aliquid.
                        </p>
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