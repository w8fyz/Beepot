<?php

require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/manager/user.php";

$logOut();

header("Location: index.php");

?>