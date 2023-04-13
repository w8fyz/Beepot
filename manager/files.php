<?php
include_once("./utils/bdd.php");
$bdd = initBDD();


$createFile = function ($postID, $fileName) use ($bdd) {
    try {
        $request = $bdd->prepare("INSERT INTO file (postID, fileName) VALUES (:postID, :fileName)");
        $request->execute(['postID' => $postID, 'fileName' => $fileName]);
    }catch (Exception $e) {
        return $e->getMessage();
    }
};

$getFiles = function ($postID) use ($bdd) {
    try {
        $request = $bdd->prepare("SELECT * FROM file WHERE postID = :postID");
        $request->execute(['postID' => $postID]);
        return $request->fetchAll(PDO::FETCH_OBJ);
    }catch (Exception $e) {
        return $e->getMessage();
    }
}

?>