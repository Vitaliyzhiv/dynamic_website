Lesson 8:
```php 
// Подготовленные запросы 
$name = 'Alex';
$age = 19;
$login = 'alex-morales';
$password = 'ales-secret';

$params = [
    'name' => $name,
    'age' => $age,
    'login' => $login,
    'password' => $password
];

//  Названия плейсхолдеров могут быть любыми, но рекомендуется их указывать явно 
$sql = ("INSERT INTO users (name, age, login, password) VALUES (:name, :age, :login, :password)");
$query = $pdo->prepare($sql);
$query->execute($params);
```

