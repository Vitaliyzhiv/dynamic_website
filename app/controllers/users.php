<?php

include  BASE_PATH . '\app\database\db.php';


// Получаем всех пользователей с помощью selectAll
$users = selectAll('users');

$role = 0;
$errMsg = '';
$successMsg = '';
$attemptsAlert = '';
$loginMinLength = 2;

$errorsArray = [
    'empty_fields_error' => 'заполните все поля',
    'login_length_error' => 'длина заголовка должна быть более ' . $loginMinLength . ' символов',
    'password_match_error' => 'пароли не совпадают',
    'email_unique_error' => 'такой email уже существует!',
    'add_user_error' => 'не удалось создать пользователя!',
    'empty_category_name_error' => 'имя категории не может быть пустым',
    'user_update_error' => 'не удалось обновить данные пользователя',
];

$errors = [];

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

    $getUsersData = selectAll('users', ['email' => $email]);
    if ($login === '' || $email === '' || $password_conf === '') {
        $errMsg = 'Не все поля заполнены';
        // Используем mb_strlen  для определения длины строки
    } elseif (mb_strlen($login, 'UTF8') < 2) {
        $errMsg = 'Логин должен быть более 2 символов';
    } elseif ($pre_pass !== $password_conf) {
        $errMsg = 'Пароли не совпадают';
    } elseif (!empty($getUsersData)) {
        $errMsg = 'Такой email уже зарегистрирован';
    } else {
        $password = password_hash($password_conf, PASSWORD_DEFAULT);
        $user = [
            'username' => $login,
            'email' => $email,
            'password' => $password,
            'admin' => $admin
        ];

        $id = insert('users', $user);
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
        $getUsersData = selectOne('users', ['email' => $email]);
        if (!empty($getUsersData)) {
            // Сравниваем пароли с формы и пароль в бд
            if (password_verify($password, $getUsersData['password'])) {
                // Если попытка входа с такой почтой удачна, то сбрасываем счетчик количества попыток;
                $_SESSION['attempts'][$email] = 0;
                // Создаем параметры сессии для данного пользователя
                userAuth($getUsersData);
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


// Код добавления пользователя через админ панель   
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create-user'])) {


    $login = trim($_POST['login']);
    $email = trim($_POST['email']);
    $pre_pass = trim($_POST['password']);
    $password_conf = trim($_POST['password-conf']);
    $admin = isset($_POST['admin']) ? 1 : 0;

    $getUsersData = selectAll('users', ['email' => $email]);

    // записываем каждую ошибку в массив $errors;
    if ($login === '' || $email === '' || $password_conf === '') {
        $errors[] = $errorsArray['empty_fields_error'];
    }

    // Проверка на минимальную длину логина
    if (mb_strlen($login, 'UTF8') < $loginMinLength) {
        $errors[] = $errorsArray['login_length_error'];
    }

    // Проверка на уникальность email
    if (!empty($getUsersData)) {
        $errors[] = $errorsArray['email_unique_error'];
    }

    // Проверка на соответствие пароля
    if ($pre_pass !== $password_conf) {
        $errors[] = $errorsArray['password_match_error'];
    }

    // Если массив ошибок пуст то вставляем пользователя в бд
    if (empty($errors)) {
        $password = password_hash($pre_pass, PASSWORD_DEFAULT);
        $user = [
            'username' => $login,
            'email' => $email,
            'password' => $password,
            'admin' => $admin
        ];
        $id = insert('users', $user);
        if ($id) {
            header("Location:" . BASE_URL . 'admin/users/index.php');
        } else {
            $errors[] = $errorsArray['add_user_error'];
        }
    }
} else {
    // echo 'GET';
    $login = '';
    $email = '';
}

// get user from get request 

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = selectOne('users', ['id' => $id]);

    $login = $user['username'];
    $email = $user['email'];
    $role = $user['admin'];
}

// Код изменения пользователя через админ панель
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit-user'])) {

    $id = $_POST['id'];
    // получаем данные по id, которые нужны для получения текущего статуса пользователя
    $user = selectOne('users', ['id' => $id]);
    // получаем текущую почту
    $currentMail = $user['email'];
    $login = trim($_POST['login']);
    $email = trim($_POST['email']);
    $pre_pass = trim($_POST['password']);
    $password_conf = trim($_POST['password-conf']);
    
    // Устанавливаем роль пользователя в зависимости был отправлен ли чекбокс,
    // если чекбокс не был отправлен, то устанавливаем роль равную текущей
    if (isset($_POST['admin'])) {
        $role = 1;
    } elseif (isset($_POST['user'])) {
        $role = 0;
    } else {
        $role = $user['admin'];
    }

    $getUsersData = selectAll('users', ['email' => $email]);

    // записываем каждую ошибку в массив $errors;
    if ($login === '' || $email === '' || $password_conf === '') {
        $errors[] = $errorsArray['empty_fields_error'];
    }

    // Проверка на минимальную длину логина
    if (mb_strlen($login, 'UTF8') < $loginMinLength) {
        $errors[] = $errorsArray['login_length_error'];
    }

    // если email изменился, то проверяем его уникальность
    if (!empty($getUsersData) && $email !== $currentMail) {
        $errors[] = $errorsArray['email_unique_error'];
    }

    // Проверка на соответствие пароля
    if ($pre_pass !== $password_conf) {
        $errors[] = $errorsArray['password_match_error'];
    }

    // Если массив ошибок пуст то вставляем пользователя в бд
    if (empty($errors)) {
        $password = password_hash($pre_pass, PASSWORD_DEFAULT);
        $user = [
            'username' => $login,
            'email' => $email,
            'password' => $password,
            'admin' => $role
        ];
        $updateUser = update($id, 'users', $user);
        if ($updateUser) {
            header("Location:" . BASE_URL . 'admin/users/index.php');
        } else {
            $errors[] = $errorsArray['update_user_error'];
        }
    }
} 