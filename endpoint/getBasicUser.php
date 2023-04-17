<?php

require parse_ini_file(dirname(__DIR__) . '/.env')['DOC_ROOT']."/utils/handleErrors.php";

require parse_ini_file(dirname(__DIR__) . '/.env')['DOC_ROOT']."/manager/user.php";


if(isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    echo json_encode($getBasicUserById($id));
}

?>