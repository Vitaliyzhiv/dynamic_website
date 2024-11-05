<?php 
include 'path.php'; 
include 'app/controllers/users.php';
include 'app/include/header.php';
?>

<!-- Form -->
<div class="container">
    <form class="my-4 row justify-content-center" method="post" action="reg.php">

        <div class="mb-3 col-12 col-md-4">
            <h2> Форма регистрации </h2>
        </div>
        <div class="w-100"></div>
        <!-- Добавляем выведение ошибок -->
        <div class="mb-3 col-12 col-md-4 errors">
            <p><?= $errMsg ?></p>
        </div>
        <div class="w-100"></div>
        <!-- Выведение сообщения об успешной регистрации -->
        <div class="mb-3 col-12 col-md-4 success">
            <p><?= $successMsg ?></p>
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="formGroupExampleInput" class="form-label">Login</label>
            <input name="login" value="<?= $login; ?>" type="text" class="form-control py-2" id="formGroupExampleInput" placeholder="Login...">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input name="email" value="<?= $email; ?>" type="email" class="form-control py-2" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input name="password" type="password" class="form-control py-2" id="exampleInputPassword1">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
            <label for="exampleInputPassword2" class="form-label">Confirm password</label>
            <input name="password-conf" type="password" class="form-control py-2" id="exampleInputPassword2">
        </div>
        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4 d-flex justify-content-between">
            <button type="submit" class="btn btn-secondary" name="button-reg">Зарегистрироваться</button>
            <a href="<?= BASE_URL . 'log.php' ?>" class="btn btn-primary">Войти</a>
        </div>
    </form>
    <!-- Form end -->
</div>

<?php include 'app/include/footer.php'; ?>