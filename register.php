<link rel="shortcut icon" href="./assets/system/icon.svg" type="image/x-icon">

<?php

require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/utils/handleErrors.php";
include_once parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/manager/user.php";

if($isLogged()) {
    header("Location: index.php");
}
function getForm($index, $error) {
    $username = "";
    $email = "";

    if(isset($_POST['username'])) {
        $username = htmlspecialchars($_POST['username']);
    }
    if(isset($_POST['email'])) {
        $email = htmlspecialchars($_POST['email']);
    }

    switch ($index) {
        case 3:
            $password = htmlspecialchars($_POST['password'] ?? "");
        case 2:
            $email = htmlspecialchars($_POST['email'] ?? "");
            $username = htmlspecialchars($_POST['username'] ?? "");
            break;
    }

    include dirname(__DIR__) . "/beepot/components/forms/register/index${index}.php";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="css/register.css">
</head>
<body>
<svg viewBox="0 0 500 500" preserveAspectRatio="xMinYMin meet">
    <path d="M0,100 C150,200 350,0 500,100 L500,00 L0,0 Z" style="stroke: none; fill:#DFE9F5FF;"></path>
</svg>
<?php
require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/utils/imports.php";
require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/utils/handleErrors.php";
require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/manager/user.php";

function needClass($error, $needed) {
    if(strpos($error, $needed)) {
        return "is-invalid";
    }
    return "";
}

?>

<div class="container-xl">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-5">
            <h1 class="title">Bienvenue sur Beepot !</h1>
            <p class="subtitle">Beepot est un réseau social moderne et ouvert à tous pour partager son quotidien et apprendre sur l'actualité. Rejoignez Beepot et soyez partout, n'importe où.</p>
        </div>
        <div class="col-md-7">

<?php


if(!isset($_POST['step'])) {

    getForm(1, "");

} else if ($_POST['step'] == 2) {

    $email = htmlspecialchars($_POST['email']);
    $username = htmlspecialchars($_POST['username']);

    if(strlen($email) > 360 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        getForm(1, "L'email est invalide");
        return;
    }

    if(!preg_match("/^[A-Za-z0-9_-]{3,35}$/", $username)) {
        getForm(1, "Le nom d'utilisateur est invalide");
        return;
    }
    if($isEmailUsed($email)) {
        getForm(1, "L'email est déjà utilisée");
        return;
    }

    if($isUsernameUsed($username)) {
        getForm(1, "Nom d'utilisateur déjà utilisée");
        return;
    }

    getForm(2, "");

} else if($_POST['step'] == 3) {
    $password = htmlspecialchars($_POST['password']);
    $passwordConfirm = htmlspecialchars($_POST['password_confirm']);

    if($password != $passwordConfirm) {
        getForm(2, "Les mots de passe ne correspondent pas");
        return;
    }

    getForm(3, "");

} else if(isset($_POST['step']) == 4) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $username = htmlspecialchars($_POST['username']);
    $acceptTOS = "";

    if(isset($_POST['acceptTOS'])) {
        $acceptTOS = htmlspecialchars($_POST['acceptTOS']);
    }

    if($acceptTOS != "on") {
        getForm(3, "Les conditions d'utilisation doivent être acceptées.");
        return;
    }

    $email = htmlspecialchars($_POST['email']);
    $username = htmlspecialchars($_POST['username']);

    if(strlen($email) > 360 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        getForm(1, "L'email est invalide");
        return;
    }

    if(!preg_match("/^[A-Za-z0-9_-]{3,35}$/", $username)) {
        getForm(1, "Le nom d'utilisateur est invalide");
        return;
    }
    if($isEmailUsed($email)) {
        getForm(1, "L'email est déjà utilisée");
        return;
    }

    if($isUsernameUsed($username)) {
        getForm(1, "Nom d'utilisateur déjà utilisée");
        return;
    }

    $error = $createUser($email, $password, $username);

    if($error != null) {
        echo "<h1>Erreur, veuillez réessayer plus tard. Code d'erreur : $error</h1>";
        return;
    }

    header("Location: index.php?status=registerSuccess");
} else {
    header("Location: index.php");
}
?>
        </div>
    </div>
</div>
</div>

</body>
</html>