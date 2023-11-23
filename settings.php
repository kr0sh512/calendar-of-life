<?php

// require_once dirname(__FILE__) . "/templates/settings.html";
// exit;

session_start();

require_once dirname(__FILE__) . "/auth/config.php";

if (!isset($_SESSION["userid"]) || $_SESSION["userid"] == '') {
    header("location: login.php");
    exit;
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $birthday = trim($_POST['date']);

    if (empty($birthday) || $birthday == '') {
        $error = '<p class="error">Дата не может быть пустой</p>';
    } else {
        $id_user = $_SESSION["userid"];
        $insertQuery = $db->prepare("UPDATE users SET birthday = ? WHERE id = ?;");
        $insertQuery->bind_param("si", $birthday, $id_user);
        $result = $insertQuery->execute();

        if ($result) {
            $error .= '<p class="success">Данные успешно обновлены!</p>';
        } else {
            $error .= '<p class="error">Ошибка, что-то пошло не так.</p>';
        }
    }
}

require_once dirname(__FILE__) . "/templates/settings.html";
