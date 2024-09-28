<?php
include "../../include/Shop.inc.php";

$db = new DB();
$res = new stdClass();

if (empty($_POST["id"]) || empty($_POST["quanity"]) || empty($_SESSION["user"])) {
    $res->code = 400;
    $res->msg = "Invalid request.";
    die(json_encode($res));
}

$sqlString = "SELECT * FROM cart WHERE user_id=" . $db->mysql->real_escape_string($_SESSION["user"]["id"]) . " AND product_id=" . $db->mysql->real_escape_string($_POST["id"]);
$sqlQuery = $db->mysql->query($sqlString);
if ($sqlQuery->num_rows > 0) {
    $res->code = 201;
    $res->msg = "Already in cart.";
    die(json_encode($res));
}

$sqlString = "INSERT INTO cart(user_id, product_id, quanity) VALUES (" . $db->mysql->real_escape_string($_SESSION["user"]["id"]) . ", " . $db->mysql->real_escape_string($_POST["id"]) . ", " . $db->mysql->real_escape_string($_POST["quanity"]) . ")";
$db->mysql->query($sqlString);

$res->code = 200;
$res->msg = "Added successfully.";
die(json_encode($res));