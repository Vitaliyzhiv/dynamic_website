<?php include 'app/include/header.php'; ?>

<!-- Блок main -->
<div class="container">
    <div class="content row">
        <!-- Main content -->
        <div class="main-content col-md-9 col-12">
            <h2>Заголовок какой-то статьи нужно несколько строк написать чтобы увидеть как будет выглядеть статья </h2>
            <div class="single_post row">
                <div class="img col-12 ">
                    <img src="https://picsum.photos/id/237/800/300" alt="" class="img-thumbnail">

                </div>

                <div class="info">
                    <i class="far fa-user"></i> <span>Имя автора</span>
                    <i class="far fa-calendar"></i> <span>July 12 2006</span>
                </div>

                <div class="single_post_text col-12 ">
                    <!-- много текста ниже -->
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quidem, vel reprehenderit fugiat debitis labore <a href="#">veniam</a> veniam, magnam nisi, labore corrupti reprehenderit autem. Autem, repudiandae? Sunt, eveniet commodi! Dignissimos, quaerat veniam. Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quidem, vel reprehenderit fugiat debitis labore veniam, magnam nisi, labore corrupti reprehenderit autem. Autem, repudiandae? Sunt, eveniet commodi! Dignissimos, quaerat veniam.
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