<?php

require_once dirname(__FILE__) . "/auth/config.php";
session_start();

$datebirth = "";

$is_auth = false;

if (isset($_SESSION["userid"]) && $_SESSION["userid"] != '') {
    $is_auth = true;
    $id = $_SESSION["userid"];
    $query = $db->prepare("SELECT birthday FROM users WHERE id = ?");
    $query->bind_param('i', $id);
    $query->execute();
    $datebirth = $query->get_result()->fetch_assoc();
}

require_once dirname(__FILE__) . "/templates/index.html";
