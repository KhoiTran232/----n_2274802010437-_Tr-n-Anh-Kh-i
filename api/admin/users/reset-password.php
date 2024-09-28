<?php
include "../../../include/Shop.inc.php";

$db = new DB();
$res = new stdClass();

if (empty($_POST["id"])) {
    $res->code = 400;
    $res->msg = "Invalid request.";
    die(json_encode($res));
}

if ($_POST["id"] == $_SESSION["user"]["id"]) {
    $res->code = 103;
    $res->msg = "Cannot reset this user's password.";
    die(json_encode($res));
}

$newPwd = Utils::generateRandomString(12);

$sqlString = "UPDATE users SET password='" . $db->mysql->real_escape_string(password_hash($newPwd, PASSWORD_BCRYPT)) . "' WHERE id=" . $db->mysql->real_escape_string($_POST["id"]) . ";";
$db->mysql->query($sqlString);

$res->code = 200;
$res->newPwd = $newPwd;
$res->msg = "Password reset successfully.";

die(json_encode($res));