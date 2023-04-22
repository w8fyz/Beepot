<?php
include_once(parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/utils/bdd.php");
$bdd = initBDD();

$haveInteracted = function ($type, $target) use ($bdd){
    require parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/manager/user.php";
    $author = $getUser();
    $request = $bdd->prepare("SELECT * FROM interaction WHERE idTarget = :idTarget AND idAuthor = :idAuthor AND interactionType = :interactionType");
    $request->execute(['idTarget' => $target, 'idAuthor' => $author->id, 'interactionType' => $type]);
    return $request->rowCount()>0;
};

$createInteraction = function ($type, $target) use ($bdd){
    require parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/manager/user.php";
    $author = $getUser();
    $request = $bdd->prepare("INSERT INTO interaction (idTarget, idAuthor, interactionType) VALUES (:idTarget, :idAuthor, :interactionType)");
    $request->execute(['idTarget' => $target, 'idAuthor' => $author->id, 'interactionType' => $type]);
};

$deleteInteraction = function ($type, $target) use ($bdd){
    require parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/manager/user.php";
    $author = $getUser();
    $request = $bdd->prepare("DELETE FROM interaction WHERE idTarget = :idTarget AND idAuthor = :idAuthor AND interactionType = :interactionType");
    $request->execute(['idTarget' => $target, 'idAuthor' => $author->id, 'interactionType' => $type]);
};

$getAllInteractions = function ($userID, $isRead) use ($bdd){
    require parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/manager/user.php";
    $addon = "";
    if(!$isRead) {
        $addon = " AND isRead = 0";
    }
    $request = $bdd->prepare("SELECT * FROM interaction INNER JOIN post ON interaction.idTarget = post.id WHERE post.authorID = :idTarget".$addon." ORDER BY interactionTime DESC");
    $request->execute(['idTarget' => $userID]);
    return $request->fetchAll(PDO::FETCH_OBJ);
};

$setAllInteractionAsRead = function ($userID) use ($bdd){
    require parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/manager/user.php";
    $request = $bdd->prepare("UPDATE interaction INNER JOIN post ON interaction.idTarget = post.id SET interaction.isRead = 1 WHERE post.authorID = :idTarget AND interaction.isRead = 0");
    $request->execute(['idTarget' => $userID]);
    return $request->fetchAll(PDO::FETCH_OBJ);
};


$getInteractionsFromPostByType = function ($type, $idPost) use ($bdd){
        require parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/manager/user.php";
        $request = $bdd->prepare("SELECT * FROM interaction WHERE idTarget = :idPost AND interactionType = :interactionType");
        $request->execute(['idPost' => $idPost, 'interactionType' => $type]);
        $nb = $request->rowCount();
        if($nb == null) {
            $nb = 0;
        }
        return $nb;
    };