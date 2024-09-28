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
    $res->msg = "Cannot apply changes to this user.";
    die(json_encode($res));
}

$sqlString = "DELETE FROM users WHERE id=" . $db->mysql->real_escape_string($_POST["id"]) . ";";
$db->mysql->query($sqlString);

$res->code = 200;
$res->msg = "User deleted.";

die(json_encode($res));