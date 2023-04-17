<?php

require parse_ini_file(dirname(__DIR__) . '/.env')['DOC_ROOT']."/utils/handleErrors.php";

require parse_ini_file(dirname(__DIR__) . '/.env')['DOC_ROOT']."/manager/interaction.php";


if(isset($_GET['type']) && isset($_GET['target'])) {
    $type = htmlspecialchars($_GET['type']);
    $target = htmlspecialchars($_GET['target']);
    echo json_encode($getInteractionsFromPostByType($_GET['type'], $_GET['target']));
}

?>