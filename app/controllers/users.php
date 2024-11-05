<?php

include  BASE_PATH . '\app\database\db.php';


$errMsg = '';
$successMsg = '';
$attemptsAlert = '';

// функция для записи переменных в сессию
/**
 * This function is used to authenticate a user and set session variables.
 * It also redirects the user to the appropriate page based on their admin status.
 *
 * @param array $userData An associative array containing user data with keys 'id', 'username', and 'admin'.
 *
 * @return void This function does not return any value. It sets session variables and redirects the user.
 */
function userAuth($userData)
{
    $_SESSION['id'] = $userData['id'];
    $_SESSION['login'] = $userData['username'];
    $_SESSION['admin'] = $userData['admin'];

    // If the user is an admin, redirect them to the admin dashboard, otherwise redirect them to the home page
    if ($_SESSION['admin'] == 1) {
        header('Location: ' . BASE_URL . 'admin/posts/index.php');
        exit();
    } else {
        header('Location: ' . BASE_URL);
        exit();
    }
}


// Код для формы регистрации
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])) {
    $login = trim($_POST['login']);
    $email = trim($_POST['email']);
    $pre_pass = trim($_POST['password']);
    $password_conf = trim($_POST['password-conf']);
    $admin = 0;

    $getUserData = selectAll('users', ['email' => $email]);
    if ($login === '' || $email === '' || $password_conf === '') {
        $errMsg = 'Не все поля заполнены';
        // Используем mb_strlen  для определения длины строки
    } elseif (mb_strlen($login, 'UTF8') < 2) {
        $errMsg = 'Логин должен быть более 2 символов';
    } elseif ($pre_pass !== $password_conf) {
        $errMsg = 'Пароли не совпадают';
    } elseif (!empty($getUserData)) {
        $errMsg = 'Такой email уже зарегистрирован';
    } else {
        $password = password_hash($password_conf, PASSWORD_DEFAULT);
        $post = [
            'username' => $login,
            'email' => $email,
            'password' => $password,
            'admin' => $admin
        ];

        $id = insert('users', $post);
        if ($id) {
            // Получаем данные о только что зарегистрировавшемся юзере
            $user = selectOne('users', ['id' => $id]);
            // вызываем функцию которая записывает данные пользователя в сессию
            userAuth($user);
        } else {
            $errMsg = 'Ошибка регистрации';
        }
    }
} else {
    // echo 'GET';
    $login = '';
    $email = '';
}

// Код для формы авторизации

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-log'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Используем сессию для записи количества попыток входа
    if (!isset($_SESSION['attempts'][$email])) {
        $_SESSION['attempts'][$email] = 0;
    }

    // Если количество попыток входа с такой почтой превысило 3, блокируем пользователя на определенное время например 5 минут
    if ($_SESSION['attempts'][$email] >= 3) {
        $timeout = 300;
        $lastAttempt = $_SESSION['attempt_time'][$email] ?? time();
        tt(value: $lastAttempt);

        if (time() - $lastAttempt < $timeout) {
            // Время до разблокировки 
            $remainingTime = $timeout - (time() - $lastAttempt);
            $attemptsAlert = '<div class="alert alert-danger" role="alert">
            Вы превысили лимит попыток входа, пожалуйста, попробуйте через ' . $remainingTime . ' секунд.
            </div>';
            // редирект на главную
            // header('Location: '. BASE_URL);
            // exit();
        } else {
            // Сброс количества попыток после таймаута
            $attemptsAlert = '';
            $_SESSION['attempts'][$email] = 0;
            unset($_SESSION['attempt_time'][$email]);
        }
    } else {
        // Сохранение времени попытки если ещё не превышен лимит
        $_SESSION['attempt_time'][$email] = time();
        tt(value: $_SESSION['attempt_time']);
    }


    if ($email === '' || $password === '') {
        $errMsg = 'Не все поля заполнены';
    } else {
        $getUserData = selectOne('users', ['email' => $email]);
        if (!empty($getUserData)) {
            // Сравниваем пароли с формы и пароль в бд
            if (password_verify($password, $getUserData['password'])) {
                // Если попытка входа с такой почтой удачна, то сбрасываем счетчик количества попыток;
                $_SESSION['attempts'][$email] = 0;
                // Создаем параметры сессии для данного пользователя
                userAuth($getUserData);
            } else {
                // Надо писать именно в таком стиле чтобы не давать подсказку, что именно неверно
                $errMsg = 'Почта либо пароль неверны';
                // Если попытка входа с такой почтой уже была в прошлом, увеличиваем счетчик
                $_SESSION['attempts'][$email]++;
                tt($_SESSION['attempts']);
            }
        } else {
            $errMsg = 'Почта либо пароль неверны';
            $_SESSION['attempts'][$email]++;
            tt($_SESSION['attempts']);
        }
    }
} else {
    $email = '';
}


