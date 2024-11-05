<?php include 'app/include/header.php'; ?>


<!-- Блок main -->
<div class="container">
    <div class="content row">
        <!-- Main content -->
        <div class="main-content col-md-9 col-12">
            <h2 class="text-center">О нас</h2>
            <p>Мы - команда профессионалов, которая рада помочь вам развить свои навыки и улучшить свою репутацию.
                Мы занимаемся разработкой сайтов на PHP, HTML, CSS.
                Наши специалисты - профессионалы своего дела.
                Мы готовы помочь вам сделать ваш сайт привлекательным, удобным и эффективным.
            </p>
            <h2 class="text-center">Виды деятельности</h2>
            <div class="post row">
                <?php
                $images = [122, 123, 124, 125, 126, 127];
                $text_about = [
                    122 => 'Программирование',
                    123 => 'Дизайн',
                    124 => 'Маркетинг',
                    125 => 'Бизнес',
                    126 => 'Технологии',
                    127 => 'Другое',
                ];
                foreach ($images as $image) {
                    echo '<div class="about_post img col-12 col-md-4">
                        <h4 class="mb-2">' . $text_about[$image] . '</h4>
                        <img src="https://picsum.photos/id/' . $image . '/200" alt="" class="img-thumbnail">
                    </div>';
                }
                ?>
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
                    <li><a href="#">Программирование</a></li>
                    <li><a href="#">Дизайн</a></li>
                    <li><a href="#">Маркетинг</a></li>
                    <li><a href="#">Бизнес</a></li>
                    <li><a href="#">Технологии</a></li>
                    <li><a href="#">Другое</a></li>

                </ul>
            </div>

        </div>

        <!-- Sidebar end -->
    </div>
</div>

<!-- Блок main конец -->

<?php include 'app/include/footer.php'; ?>