<?php
include "../../include/Shop.inc.php";

$db = new DB();
$res = new stdClass();

if (empty($_POST["id"]) || empty($_SESSION["user"])) {
    $res->code = 400;
    $res->msg = "Invalid request.";
    die(json_encode($res));
}

$sqlString = "DELETE FROM cart WHERE product_id=" . $db->mysql->real_escape_string($_POST["id"]) . " AND user_id=" . $db->mysql->real_escape_string($_SESSION["user"]["id"]);
$db->mysql->query($sqlString);

$res->code = 200;
$res->msg = "Cart item deleted.";

die(json_encode($res));