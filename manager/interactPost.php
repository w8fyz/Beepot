<?php

include_once(parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/utils/handleErrors.php");

if(isset($_GET['type']) && isset($_GET['target'])) {

    $env = parse_ini_file(dirname(__DIR__).'/.env');
    require $env['DOC_ROOT'].'/manager/user.php';
    if(!$isLogged()){
        echo json_encode("false");
    }
    $type = $_GET['type'];
    $target = $_GET['target'];

    require $env['DOC_ROOT'].'/manager/interaction.php';

    $haveInteract = $haveInteracted($type, $target);

    if($haveInteract) {
        $deleteInteraction($type, $target);
    } else {
        $createInteraction($type, $target);
    }

    echo json_encode($haveInteract);
}