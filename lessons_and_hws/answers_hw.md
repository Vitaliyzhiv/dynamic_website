1. Решение задачи с урока 6 используя PDO:

``` php
// считаем количество строк в таблице перед вставкой новых данных
$count_before_insert = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();

$insert_data = [
    ['Oleg', 24, 'oleg_nik', 'afsaffwSAz'],
    ['Petya', 21, 'petya_12414k', 'a535235agsjSz'],
    ['Vasya', 20, 'vasya_kq', 'Tryssg12fsfd3'],
];

// Подготовка запроса и вставка его используя цикл
$stmt = $pdo->prepare("INSERT INTO users (name, age, login, password) VALUES (?,?,?,?)");


try {
    $pdo->beginTransaction();

    foreach ($insert_data as $row)
    {
        $stmt->execute($row);
    }
    $pdo->commit();
}catch (Exception $e){
    $pdo->rollback();
    throw $e;
}

$count_after_insert = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();

if ($count_after_insert  == $count_before_insert + count($insert_data) ) {
    echo 'Данные добавлены';
} else {
    echo 'Данные не добавлены';
}
```

2. Решение задачи с урока 8 используя PDO:
```php 
require_once 'setting.php';

// Подключение к базе данных через PDO.
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

//  Удаляем все записи у которых id делится на 2 без остатка
$stmt = $pdo->prepare("DELETE FROM users WHERE id_user % 2 = 0");
//  Проверяем результаты используя if else
if ($stmt->execute()) {
    echo "Записи успешно удалены";
} else {
    echo "Error: " . $stmt->errorInfo();
}

$name = 'Rita-Ivy';


// Обновление данных (в данном случае только имя) для user с id_user = 1
$data = [
    'name' => $name,
    'id' => 1,
];
$sql = "UPDATE users SET name=:name  WHERE id_user=:id";
$stmt= $pdo->prepare($sql);
$stmt->execute($data);

if ($stmt) {
    echo "Данные обновлены";
} else {
    echo "Error: " . $stmt->errorInfo();
}


```


