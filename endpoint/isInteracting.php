<?php

require parse_ini_file(dirname(__DIR__) . '/.env')['DOC_ROOT']."/utils/handleErrors.php";
require parse_ini_file(dirname(__DIR__) . '/.env')['DOC_ROOT']."/manager/user.php";
require parse_ini_file(dirname(__DIR__) . '/.env')['DOC_ROOT']."/manager/interaction.php";


if(isset($_GET['type']) && isset($_GET['target'])) {
    if(!$isLogged()) {
        echo json_encode("not logged");
        return;
    }
    $type = htmlspecialchars($_GET['type']);
    $target = htmlspecialchars($_GET['target']);
    echo json_encode($haveInteracted($_GET['type'], $_GET['target']));
}

?>