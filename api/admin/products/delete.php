<?php
include "../../../include/Shop.inc.php";

$db = new DB();
$res = new stdClass();

if (empty($_POST["id"])) {
    $res->code = 400;
    $res->msg = "Invalid request.";
    die(json_encode($res));
}

$sqlString = "DELETE FROM products WHERE id=" . $db->mysql->real_escape_string($_POST["id"]) . ";";
$db->mysql->query($sqlString);

$res->code = 200;
$res->msg = "Product deleted.";

die(json_encode($res));