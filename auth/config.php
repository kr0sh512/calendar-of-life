<?php
define('DBSERVER', 'localhost'); // сервер с базой данных
define('DBUSERNAME', 'kr0sh512_lifer'); // имя пользователя
define('DBPASSWORD', 'S3GY6XGzLPN_ZKLZ'); // пароль
define('DBNAME', 'kr0sh512_lifer'); // название базы
 
/* соединяемся с базой */
$db = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME);
 
// проверяем соединение
if($db === false){
    die("Ошибка соединения с базой. " . mysqli_connect_error());
}
?>