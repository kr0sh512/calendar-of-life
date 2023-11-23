<?php

// require_once dirname(__FILE__) . "/templates/settings.html";
// exit;

session_start();

require_once dirname(__FILE__) . "/auth/config.php";

if (!isset($_SESSION["userid"]) || $_SESSION["userid"] == '') {
    header("location: login.php");
    exit;
}

require_once dirname(__FILE__) . "/templates/settings.html";
