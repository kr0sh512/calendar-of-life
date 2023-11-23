<?php

// подключаем служебные файлы, которые создали раньше
require_once dirname(__FILE__) . "/auth/config.php";
require_once dirname(__FILE__) . "/auth/session.php";
// сообщение об ошибке, на старте — пустое
$error = '';


// если на странице нажали кнопку регистрации
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $error = 'Ошибка';
    // берём данные из формы
    $fullname = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST["confirm_password"]);
    $password_hash = password_hash($password, PASSWORD_BCRYPT);


    if ($query = $db->prepare("SELECT * FROM users WHERE email = ?")) {
        $error = '';
        // указываем, что почта — это строка
        $query->bind_param('s', $email);
        $query->execute();
        // сначала проверяем, есть ли такой аккаунт в базе
        $query->store_result();
        if ($query->num_rows > 0) {
            $error .= '<p class="error">Пользователь с такой почтой уже зарегистрирован!</p>';
        } else {
            // проверяем требование к паролю
            if (strlen($password) < 6) {
                $error .= '<p class="error">Пароль не должен быть короче 6 символов.</p>';
            }

            // проверяем, ввели ли пароль второй раз
            if (empty($confirm_password)) {
                $error .= '<p class="error">Пожалуйста, подтвердите пароль.</p>';
            } else {
                // если пароли не совпадают
                if (empty($error) && ($password != $confirm_password)) {
                    $error .= '<p class="error">Введённые пароли не совпадают.</p>';
                }
            }
            // если ошибок нет
            if (empty($error)) {
                // добавляем запись в базу данных
                $insertQuery = $db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?);");
                $insertQuery->bind_param("sss", $fullname, $email, $password_hash);
                $result = $insertQuery->execute();
                // если всё прошло успешно
                if ($result) {
                    $error .= '<p class="success">Вы успешно зарегистрировались!</p>';
                    $query = $db->prepare("SELECT * FROM users WHERE email = ?");
                    $query->bind_param('s', $email);
                    $query->execute();
                    $row = $query->get_result()->fetch_assoc();
                    $_SESSION["userid"] = $row['id'];
                    $_SESSION["user"] = $row;
                    // перенаправляем пользователя на внутреннюю страницу
                    header("location: index.php");
                    exit;
                    // если случилась ошибка
                } else {
                    $error .= '<p class="error">Ошибка регистрации, что-то пошло не так.</p>';
                }
            }
        }
    }
    // закрываем соединение с базой данных
    mysqli_close($db);
}

require_once dirname(__FILE__) . "/templates/register.html";
