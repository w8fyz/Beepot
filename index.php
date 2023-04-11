<!doctype html>
<html lang="fr">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Beepot</title>
</head>

<?php
require "components/header.php";
include "utils/messages.php";

include "manager/post.php";

formatBeep("Fyz (I made this 🥴)", "Fyz", "Woaaah, is that.. A... Post ??? Omggg", ["salut"], date('d-m-y h:i:s'), 10);
loadBeep();
?>
<body>
</body>
</html>