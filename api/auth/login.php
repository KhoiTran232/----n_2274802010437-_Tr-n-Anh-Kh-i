<?php
include "../../include/Shop.inc.php";

$db = new DB();
$res = new stdClass();

if (empty($_POST["email"]) || empty($_POST["password"]) || !empty($_SESSION["user"])) {
    $res->code = 400;
    $res->msg = "Invalid request.";
    die(json_encode($res));
}

$sqlString = "SELECT * FROM users WHERE email='" . $db->mysql->real_escape_string($_POST["email"]) . "';";
$sqlQuery = $db->mysql->query($sqlString);

if ($sqlQuery->num_rows <= 0) {
    $res->code = 401;
    $res->msg = "Invalid email/password.";
    die(json_encode($res));
}

$sqlResult = $sqlQuery->fetch_assoc();

if (!password_verify($_POST["password"], $sqlResult["password"])) {
    $res->code = 401;
    $res->msg = "Invalid email/password.";
    die(json_encode($res));
}

$_SESSION["user"] = $sqlResult;
$_SESSION["email"] = $_POST["email"];

$res->code = 200;
$res->msg = "Logged in successfully.";
die(json_encode($res));