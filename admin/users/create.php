<?php
// Починаємо сесію

include '../../path.php';
include  BASE_PATH . '/app/controllers/users.php';
include BASE_PATH . '/app/include/header-admin.php';

?>

<div class="container">
    <div class="row">
        <?php include  BASE_PATH . '/app/include/sidebar-admin.php'; ?>

        <div class="posts col-9">
            <div class="button row m-3">
                <a href="create.php" class="col-2 btn btn-success">Добавить</a>
                <a href="index.php" class="col-2 btn btn-primary">Управление </a>
            </div>
            <div class="row m-3 title-table">
                <h2 class="text-center">Добавление пользователя</h2>
            </div>
            <div class="row m-3 add-post">
                <!-- Форма добавления пользователя-->
                <form action="create.php" method="post">
                    <?php include BASE_PATH . '/app/helps/errorsinfo.php'; ?>
                    <div class="mb-3 col">
                        <label for="formGroupExampleInput" class="form-label">Login</label>
                        <input name="login" value="<?= $login; ?>" type="text" class="form-control py-2"
                            id="formGroupExampleInput" placeholder="Login...">
                    </div>

                    <div class="mb-3 col">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input name="email" value="<?= $email; ?>" type="email" class="form-control py-2"
                            id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>

                    <div class="mb-3 col">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control py-2" id="exampleInputPassword1">
                    </div>

                    <div class="mb-3 col">
                        <label for="exampleInputPassword2" class="form-label">Confirm password</label>
                        <input name="password-conf" type="password" class="form-control py-2"
                            id="exampleInputPassword2">
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" value="1" name="admin" type="checkbox"
                            style="width: 16px; height: 16px; border: 2px solid #007bff; border-radius: 4px;">
                        <label class="form-check-label pt-1 ms-2" for="flexCheckChecked">
                            Admin
                        </label>
                    </div>
                    <div class="col">
                        <button type="submit" name="create-user" class="btn btn-primary mb-3">Создать пользователя</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<?php include BASE_PATH . '/app/include/footer.php'; ?>