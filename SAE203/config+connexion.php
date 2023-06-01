<?php
define("DB", "mysql:host=127.0.0.1;dbname=wikDB");
define("USER", "toto");
define("PWD", "050904100402PA");

try {
    $conn = new PDO(DB, USER, PWD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
