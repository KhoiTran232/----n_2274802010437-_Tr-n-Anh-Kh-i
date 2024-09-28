<?php
include "../../include/Shop.inc.php";
session_destroy();

$res = new stdClass();
$res->code = 200;
$res->msg = "Logged out successfully.";
die(json_encode($res));