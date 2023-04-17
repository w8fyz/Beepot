<?php

require parse_ini_file(dirname(__DIR__) . '/.env')['DOC_ROOT']."/utils/handleErrors.php";

require parse_ini_file(dirname(__DIR__) . '/.env')['DOC_ROOT']."/manager/files.php";


if(isset($_GET['idPost'])) {
    $id = htmlspecialchars($_GET['idPost']);
    echo json_encode($getFiles($id));
}

?>