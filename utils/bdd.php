<?php
function initBDD() {
    $env = parse_ini_file(dirname(__DIR__).'/.env');

    try {
        $conn = new PDO("mysql:host=" . $env['HOST'] . ";dbname=" . $env['BDD'], $env['USER'], $env['PASS']);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
        return $conn;
    } catch(PDOException $e) {
        header("Location: error.php");
    }
}
?>

