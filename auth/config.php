<?php
define('DBSERVER', 'localhost');
define('DBUSERNAME', 'kr0sh512_lifer');
define('DBPASSWORD', 'S3GY6XGzLPN_ZKLZ');
define('DBNAME', 'kr0sh512_lifer');

$db = mysqli_connect(DBSERVER, DBUSERNAME, DBPASSWORD, DBNAME);

if ($db === false) {
    die("Ошибка соединения с базой. " . mysqli_connect_error());
}
