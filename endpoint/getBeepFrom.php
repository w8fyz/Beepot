<?php

require parse_ini_file(dirname(__DIR__) . '/.env')['DOC_ROOT']."/utils/handleErrors.php";

require parse_ini_file(dirname(__DIR__) . '/.env')['DOC_ROOT']."/manager/post.php";

if(isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    if (isset($_GET['lastID'])) {
        $lastID = htmlspecialchars($_GET['lastID']);
        $getBeepsFrom($id, $lastID);
    } else {
        $getBeepsFrom($id);
    }
}
?>