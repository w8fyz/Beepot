<?php

require "utils/handleErrors.php";

require "manager/post.php";

if(isset($_GET['lastID'])) {
    $lastID = htmlspecialchars($_GET['lastID']);
    $getTimeline($lastID);
} else {
    $getTimeline();
}

?>