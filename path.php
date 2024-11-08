<?php
/* 
* Данный файл содержит функцию которая возвращает корневую директорию
*/
define('BASE_PATH', __DIR__);
define('BASE_URL', 'http://localhost/dynamic_website/');
// Константа ROOT_PATH нужна для определения абсолютного пути к корневой директории текущего файла,
// что позволяет использовать его для построения корректных путей к ресурсам и подключениям,
// независимо от того, где находится скрипт на сервере.
define('ROOT_PATH', realpath(dirname(__FILE__)));

define('IMAGES_URL', value: 'http://localhost/dynamic_website/assets/images/');