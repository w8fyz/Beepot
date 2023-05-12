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


$nbPosts = $countPostFor($user->id);
$nbLike = $getCountInteractionByType($user->id, "LIKE");
$date = date('d/m/Y H:i:s', $user->creationTimestamp);
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
                    <p class="card-text"><?=$user->bio?></p>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <p class="card-text"><i class="bi bi-calendar"></i> <?= $date ?></p>

                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <p class="card-text"><i class="bi bi-chat-dots"></i> <?= $nbPosts?></p>

                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <p class="card-text"><i class="bi bi-heart"></i> <?= $nbLike?></p>

                </div>
            </div>
        </div>

    </div>
    <?php if($isLogged() && $getUser()->id == $user->id) {?>
    <button style="margin-left: 10px; margin-bottom: 20px" type="button" class="btn btn-warning" data-toggle="modal" data-target="#editProfile"
            onclick="openEditProfile()">
        Modifier
    </button>
<?php }?>
</div>
<div id="beep-full-container">
<?php

$getBeepsFrom($user->id);

require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/utils/messages.php";

require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/manager/createPost.php";
?>
<div class="popup" id="popup" onclick="popupClick()">
</div></div>
<script src="./js/beepLoader.js"></script>
<script src="./js/beepInteractions.js"></script>
<script src="./js/utils.js"></script>
<script>

    function openEditProfile() {
        let editModal = document.querySelector("#editProfile");
        new bootstrap.Modal(editModal).show();
    }

    function closeEditProfile() {
        let editModal = document.querySelector("#editProfile");
        new bootstrap.Modal(editModal).hide();
    }
</script>

<div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="editProfileLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileLabel">Modifier le profil</h5>
                <button onclick="closeEditProfile()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="endpoint/editProfile.php" method="post">
                <div class="modal-body">


                    <!-- Nom -->
                    <div class="form-group">
                        <label for="nameInput">Nom</label>
                        <input type="text" class="form-control" id="nameInput" name="name" value=<?= $user->displayName ?>>
                    </div>

                    <!-- Bio -->
                    <div class="form-group">
                        <label for="bioInput">Bio</label>
                        <textarea class="form-control" id="bioInput" rows="3" name="bio"><?= $user->bio ?></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">Enregistrer</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeEditProfile()">Fermer</button>
                </div>
            </form>
        </div>
    </div>
</div></body>
</html>