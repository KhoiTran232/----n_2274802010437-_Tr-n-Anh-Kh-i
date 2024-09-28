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

if ($sqlQuery->num_rows > 0) {
    $res->code = 200;
    $res->msg = "Account already existed.";
    die(json_encode($res));
}

$sqlString = "INSERT INTO users(email, password) VALUES ('" . $db->mysql->real_escape_string($_POST["email"]) . "','" . $db->mysql->real_escape_string(password_hash($_POST["password"], PASSWORD_BCRYPT)) . "')";
$db->mysql->query($sqlString);

$res->code = 200;
$res->msg = "Account created successfully.";
die(json_encode($res));