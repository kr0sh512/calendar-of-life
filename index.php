<?php
// стартуем сессию
session_start();

// если пользователь не авторизован, то перенаправляем его на страницу входа
if (!isset($_SESSION["userid"]) || $_SESSION["userid"] == '') {
    //header("location: login.php");
    //exit;
    // echo 'не авторизирован ';
    // echo 'userid '.$_SESSION["userid"].' ';
    // echo 'user '.$_SESSION["user"].' ';
    // echo 'isset '.isset($_SESSION["userid"]).' ';
    // echo 'equal '.($_SESSION["userid"] == '').' ';
}

require_once dirname(__FILE__) . "/templates/index.html";
