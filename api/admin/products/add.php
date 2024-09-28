<?php
include "../../../include/Shop.inc.php";

$db = new DB();
$res = new stdClass();

if (empty($_POST["name"]) || empty($_POST["brand"]) || empty($_POST["description"]) || empty($_POST["price"]) || empty($_POST["image"]) || empty($_POST["outOfStock"])) {
    $res->code = 400;
    $res->msg = "Invalid request.";
    die(json_encode($res));
}

$sqlString = "INSERT INTO products(name, brand, description, image, price, out_of_stock) VALUES ('" . $db->mysql->real_escape_string($_POST["name"]) . "', '" . $db->mysql->real_escape_string($_POST["brand"]) . "', '" . $db->mysql->real_escape_string($_POST["description"]) . "', '" . $db->mysql->real_escape_string($_POST["image"]) . "', " . $db->mysql->real_escape_string($_POST["price"]) . ", " . $db->mysql->real_escape_string($_POST["outOfStock"]) . ")";
$db->mysql->query($sqlString);

$res->code = 200;
$res->msg = "Created successfully.";
die(json_encode($res));