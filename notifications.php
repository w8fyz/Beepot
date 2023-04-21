<?php
require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/utils/handleErrors.php";

?>

    <!doctype html>
    <html lang="fr" xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/notifications.css">
        <title>Beepot</title>
    </head>

<?php
require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/components/header.php";
require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/manager/interaction.php";
require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/manager/user.php";

if(!$isLogged()) {
    header("Location: login.php");
}

$interactions = $getAllInteractions($getUser()->id, false);
foreach ($interactions as $interaction) {
    $author = $getUserById($interaction->authorID);
?>
<body>
<div class="notification">
    <div class="card">
        <div class="card-body">
            <div class="d-flex">
                <img src="https://via.placeholder.com/50x50" class="rounded-circle me-3" width="50" height="50" alt="Photo de profil">
                <div>
                    <h5 class="card-title mb-1"><?= $author->displayName ?></h5>
                    <?php

                    if($interaction->interactionType === "LIKE") {
                        echo '<p class="card-text mb-0"><i style="color: #e74c3c;" class="bi bi-heart-fill"></i> A liké votre Beep</p>';
                    } else if($interaction->interactionType === "BOOST") {
                        echo '<p class="card-text mb-0"><i style="color: rgb(255, 155, 0);" class="bi bi-rocket-takeoff-fill"></i> A boosté votre Beep</p>';
                    } else if($interaction->interactionType === "COMMENT") {
                        echo '<p class="card-text mb-0"><i style="color: #57c4a6;" class="bi bi-chat-left-fill"></i> A commenté votre Beep</p>';
                    } else if($interaction->interactionType === "FOLLOW") {
                        echo '<p class="card-text mb-0"><i class="bi bi-person-fill-add"></i> vous a suivis</p>';
                    }


                    ?>
                    <small class="text-muted"><?= $interaction->interactionTime ?></small>
                </div>
            </div>
        </div>
    </div>

</div>
<?php }?>

</body>
</html>