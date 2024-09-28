<?php
session_start();

include "utils/DB.inc.php";
include "utils/Global.inc.php";

if (str_contains($_SERVER["REQUEST_URI"], "/api/")) {
    header("Content-type: application/json; charset=utf-8");
}

if (str_contains($_SERVER["REQUEST_URI"], "/admin")) {
    if (!Utils::isLoggedIn()) {
        if (str_contains($_SERVER["REQUEST_URI"], "/api/")) {
            header("Content-type: application/json; charset=utf-8");
            http_response_code(403);
            die();
        }

        header("Location: /pages/auth/login.php");
        die();
    }

    if ($_SESSION["user"]["is_admin"] == false) {
        if (str_contains($_SERVER["REQUEST_URI"], "/api/")) {
            header("Content-type: application/json; charset=utf-8");
            http_response_code(403);
            die();
        }
        
        header("Location: /");
        die();
    }
}