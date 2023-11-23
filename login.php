<?php

require_once dirname(__FILE__) . "/auth/config.php";
require_once dirname(__FILE__) . "/auth/session.php";

$error = '';
// если нажата кнопка входа
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // если не указана почта
    if (empty($email)) {
        $error .= '<p class="error">Введите адрес электронной почты.</p>';
    }

    // если не указан пароль
    if (empty($password)) {
        $error .= '<p class="error">Введите пароль.</p>';
    }

    // если ошибок нет
    if (empty($error)) {
        // берём данные пользователя
        if ($query = $db->prepare("SELECT * FROM users WHERE email = ?")) {
            $query->bind_param('s', $email);
            $query->execute();
            $row = $query->get_result()->fetch_assoc();
            // смотрим, есть ли такой пользователь в базе
            if ($row) {
                // если пароль правильный
                if (password_verify($password, $row['password'])) {
                    // стартуем новую сессию
                    $_SESSION["userid"] = $row['id'];
                    $_SESSION["user"] = $row;
                    echo 'userid ' . $_SESSION["userid"] . ' ';
                    echo 'user ' . $_SESSION["user"] . ' ';
                    echo 'isset ' . isset($_SESSION["userid"]) . ' ';
                    echo 'equal ' . ($_SESSION["userid"] != '') . ' ';
                    // перенаправляем пользователя на внутреннюю страницу
                    header("location: index.php");
                    exit;
                    // если пароль не подходит
                } else {
                    $error .= '<p class="error">Введён неверный пароль.</p>';
                }
                // если пользователя нет в базе
            } else {
                $error .= '<p class="error">Нет пользователя с таким адресом электронной почты.</p>';
            }
        }
    }
    // закрываем соединение с базой данных
    mysqli_close($db);
}

require_once dirname(__FILE__) . "/templates/login.html";
