<?php
include_once(parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/utils/bdd.php");
$bdd = initBDD();

$getUserIDByHash = function($uuid, $ipAdress) use ($bdd) {
    try {
        $key = parse_ini_file(dirname(__DIR__).'/.env')['SHA_KEY'];
        $ipHash = hash_hmac('sha256', $ipAdress, $key);
        $request = $bdd->prepare("SELECT idUser FROM sessionID 
              WHERE uuid = :uuid AND ipHash = :ipHash");
        $request->execute(['uuid' => $uuid, 'ipHash' => $ipHash]);
        return $request->fetch(PDO::FETCH_OBJ)->idUser;
    }catch (Exception $e) {
        return null;
    }
};

$createUserHash = function ($id, $uuid, $ipAdress) use ($bdd) {
    try {
        $key = parse_ini_file(dirname(__DIR__).'/.env')['SHA_KEY'];
        $ipHash = hash_hmac('sha256', $ipAdress, $key);
        $request = $bdd->prepare("INSERT INTO sessionID (idUser, uuid, ipHash) 
VALUES (:idUser, :uuid, :ipHash)");
        $request->execute(['idUser' => $id, 'uuid' => $uuid, 'ipHash' => $ipHash]);
    }catch (Exception $e) {

    }
};