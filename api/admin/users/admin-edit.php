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

$sqlString = "UPDATE users SET is_admin=!is_admin WHERE id=" . $db->mysql->real_escape_string($_POST["id"]) . ";";
$db->mysql->query($sqlString);

$res->code = 200;
$res->msg = "Permission changed successfully.";

die(json_encode($res));