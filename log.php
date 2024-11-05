<?php

include 'path.php';
include 'app/controllers/users.php';
include 'app/include/header.php';

?>

<!-- Form -->
<div class="container">
    <form class="my-4 row justify-content-center" method="post" action="log.php">
        <div class="mb-3 col-12 col-md-4">
            <!-- alert atempts -->
             <?= $attemptsAlert;?>
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <h2> Авторизация</h2>
        </div>
        <div class="w-100"></div>
        <!-- Добавляем выведение ошибок -->
        <div class="mb-3 col-12 col-md-4 errors">
            <p><?= $errMsg ?></p>
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="formGroupExampleInput" class="form-label">Email</label>
            <input name="email" type="text" value="<?= $email ?>" class="form-control py-2" id="formGroupExampleInput" placeholder="your email..">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input name="password" type="password" class="form-control py-2" id="exampleInputPassword1">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4 d-flex justify-content-between">
            <button type="submit" name="button-log" class="btn btn-secondary">Войти</button>
            <a href="<?= BASE_URL . 'reg.php' ?>" class="btn btn-primary">Зарегистрироваться</a>
        </div>
    </form>
    <!-- Form end -->
</div>

<!-- footer -->
<?php include 'app/include/footer.php'; ?>