<?php
include "../../../include/Shop.inc.php";

$db = new DB();
$res = new stdClass();

if (empty($_POST["id"]) || empty($_POST["title"]) || empty($_POST["image"]) || empty($_POST["btnTitle"]) || empty($_POST["btnLink"])) {
    $res->code = 400;
    $res->msg = "Invalid request.";
    die(json_encode($res));
}

$sqlString = "UPDATE homedata SET title='" . $db->mysql->real_escape_string($_POST["title"]) . "',image='" . $db->mysql->real_escape_string($_POST["image"]) . "',btn_title='" . $db->mysql->real_escape_string($_POST["btnTitle"]) . "',btn_link='" . $db->mysql->real_escape_string($_POST["btnLink"]) . "' WHERE id=" . $db->mysql->real_escape_string($_POST["id"]) . ";";
$db->mysql->query($sqlString);

$res->code = 200;
$res->msg = "Edited successfully.";
die(json_encode($res));