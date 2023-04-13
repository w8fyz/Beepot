<?php

require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/utils/handleErrors.php";

require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/manager/post.php";

if(isset($_GET['lastID'])) {
    $lastID = htmlspecialchars($_GET['lastID']);
    $getTimeline($lastID);
} else {
    $getTimeline();
}

?>