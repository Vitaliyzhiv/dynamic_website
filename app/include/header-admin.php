<!doctype html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My blog</title>
    <!-- Google FOnts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/admin.css'; ?>">
</head>

<body>

    <header class="container-fluid">

        <div class="container">
            <div class="row">
                <div class="col-4">
                    <h1>
                        <a href="<?= BASE_URL; ?>">My Blog</a>
                    </h1>
                </div>
                <nav class="col-8">
                    <ul>
                        <li>
                            <!-- Если по ключу login в суперглобальном массиве SESSION не пусто , то выводим имя пользователя, в ином случае слово кабинет -->
                            <?php if (isset($_SESSION['id'])) : ?>
                                <a href="#"><i class="fa-solid fa-user"></i> <?= $_SESSION['login'] ?></a>
                                <ul>
                                    <li><a href="#">Админ панель</a></li>
                        </li>
                    </ul>
                    <li>
                        <!-- <a class="p-0" href="#">
                                            <form action="" method="POST" style="display: inline;">
                                                <input type="hidden" name="logout" value="1">
                                                <button class="p-2" style="min-width: 100%;" type="submit" >Выход</button>
                                            </form>
                                        </a> -->
                        <a href="<?= BASE_URL . 'logout.php' ?>"></i>Выход</a>
                    </li>
                <?php endif; ?>

                </ul>
                </nav>
            </div>
        </div>
    </header>