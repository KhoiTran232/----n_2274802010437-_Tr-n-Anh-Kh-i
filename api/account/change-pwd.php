<?php
include "../../include/Shop.inc.php";

$db = new DB();
$res = new stdClass();

if (empty($_POST["oldPwd"]) || empty($_POST["newPwd"])) {
    $res->code = 400;
    $res->msg = "Invalid request.";
    die(json_encode($res));
}

if (!password_verify($_POST["oldPwd"], $_SESSION["user"]["password"])) {
    $res->code = 401;
    $res->msg = "Wrong old password.";
    die(json_encode($res));
}

$sqlString = "UPDATE users SET password = '" . password_hash($_POST["newPwd"], PASSWORD_BCRYPT) . "' WHERE id=" . $db->mysql->real_escape_string($_SESSION["user"]["id"]) . ";";
$db->mysql->query($sqlString);

$sqlString = "SELECT * FROM users WHERE id=" . $_SESSION["user"]["id"];
$sqlQuery = $db->mysql->query($sqlString);

$_SESSION["user"] = $sqlQuery->fetch_assoc();

$res->code = 200;
$res->msg = "Password changed successfully.";

die(json_encode($res));