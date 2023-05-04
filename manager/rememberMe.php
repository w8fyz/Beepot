<?php
include_once(parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/utils/bdd.php");
$bdd = initBDD();

$getUserIDByHash = function($hash) use ($bdd) {
    try {
        $request = $bdd->prepare("SELECT idUser FROM remember_me WHERE hash = :hash");
        $request->execute(['hash' => $hash]);
        return $request->fetch(PDO::FETCH_OBJ);
    }catch (Exception $e) {
        return null;
    }
};

$createUserHash = function ($hash) use ($bdd) {
    try {
        $request = $bdd->prepare("UPDATE idUser SET ''");
        $request->execute(['hash' => $hash]);
    }catch (Exception $e) {

    }
}