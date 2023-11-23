<?php
session_start();

$is_auth = false;

if (isset($_SESSION["userid"]) && $_SESSION["userid"] != '') {
    $is_auth = true;
    //header("location: login.php");
    //exit;

}

require_once dirname(__FILE__) . "/templates/index.html";
