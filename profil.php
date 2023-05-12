<?php
require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/manager/user.php";
if(!isset($_GET['id'])) {
    header("Location: index.php");
}

$user = $getUserById(htmlspecialchars($_GET['id']));
if($user == null) {
    header("Location: index.php");
}

require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/utils/handleErrors.php";

?>

<!doctype html>
<html lang="fr" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/profil.css">
    <title>Beepot</title>
</head>

<?php
require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/utils/imports.php";
require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/components/header.php";
require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/manager/interaction.php";

require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/manager/post.php";

?>
<body>

<div class="container">
    <div>
        <img src="assets/uploads/<?=$user->profile_banner?>" alt="Profile Banner" class="profile-banner profile-corner">
        <div>

            <img src="assets/uploads/<?=$user->profile_picture?>" alt="Profile Picture" class="profile-picture">
        </div>

        <div class="profile-username profile-corner">
            <h2><?=$user->displayName?></h2>
            <p>@<?=$user->username?></p>
        </div>

        <div class="profile-details">
            <div class="card desc" style="width: 56.5rem;">
                <div class="card-body">
                    <p class="card-text">Je viens d'arriver ici, bonjour !</p>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <p class="card-text"><i class="bi bi-calendar"></i> Date d'inscription: <?php echo date('d/m/Y'); ?></p>

                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <p class="card-text"><i class="bi bi-chat-dots"></i> Nombre de Beeps: 100</p>

                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <p class="card-text"><i class="bi bi-heart"></i> Nombre de likes reçus: 500</p>

                </div>
            </div>
        </div>

    </div>


</div>

<?php

$getBeepsFrom($user->id);

require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/utils/messages.php";

require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/manager/createPost.php";
?>
<div class="popup" id="popup" onclick="popupClick()">
</div>
<script src="./js/beepLoader.js"></script>
<script src="./js/beepInteractions.js"></script>
<script src="./js/utils.js"></script>
</body>
</html>