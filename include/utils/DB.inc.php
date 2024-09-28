<?php
class DB {
    public mysqli $mysql;

    public function __construct() {
        $this->mysql = new mysqli("localhost", "khoitran", "khoitran230204", "shoesshop");
    }
}