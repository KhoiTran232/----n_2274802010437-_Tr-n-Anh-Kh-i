<?php
include "../../../include/Shop.inc.php";

$db = new DB();
$res = new stdClass();

if (empty($_POST["id"]) || empty($_POST["name"]) || empty($_POST["brand"]) || empty($_POST["description"]) || empty($_POST["price"]) || empty($_POST["image"]) || empty($_POST["outOfStock"])) {
    $res->code = 400;
    $res->msg = "Invalid request.";
    die(json_encode($res));
}

$sqlString = "UPDATE products SET name='" . $db->mysql->real_escape_string($_POST["name"]) . "', brand='" . $db->mysql->real_escape_string($_POST["brand"]) . "', description='" . $db->mysql->real_escape_string($_POST["description"]) . "', image='" . $db->mysql->real_escape_string($_POST["image"]) . "', price=" . $db->mysql->real_escape_string($_POST["price"]) . ", out_of_stock=" . $db->mysql->real_escape_string($_POST["outOfStock"]) . " WHERE id=" . $db->mysql->real_escape_string($_POST["id"]) . ";";
$db->mysql->query($sqlString);

$res->code = 200;
$res->msg = "Edited successfully.";
die(json_encode($res));