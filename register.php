<link rel="shortcut icon" href="./assets/system/icon.svg" type="image/x-icon">

<?php

require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/utils/handleErrors.php";
include_once parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/manager/user.php";

if($isLogged()) {
    header("Location: index.php");
}
function getForm($index, $error){
    $username = "";
    $email = "";

    if(isset($_POST['username'])) {
        $username = htmlspecialchars($_POST['username']);
    }
    if(isset($_POST['email'])) {
        $email = htmlspecialchars($_POST['email']);
    }
    if($index == 1) {

        echo '
        <div class="card mt-5">
          <div class="card-body">
            <div class="text-center">
              <img src="assets/system/icon.svg" alt="logo" class="mb-3" width="72" height="72">
              <h1 class="h3 mb-3">Inscription</h1>
            </div>
            <form method="post" action="register.php">
<div class="input-group mb-3">
  <span class="input-group-text">@</span>
  <div class="form-floating ' . needClass($error, 'utilisateur') . '">
    <input type="text" class="form-control ' . needClass($error, 'utilisateur') . '" id="floatingInputGroup1" placeholder="Nom d\'utilisateur" name="username" value="' . $username . '">
    <label for="floatingInputGroup1">Nom d\'utilisateur</label>
  </div>
          <div class="invalid-feedback">
            ' . $error . '
  </div>
</div>
<div class="input-group mb-3">
    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
  <div class="form-floating ' . needClass($error, 'email') . '">
    <input type="email" class="form-control ' . needClass($error, 'email') . '" id="floatingInputGroup1" placeholder="Adresse mail" name="email" value="' . $email . '">
    <label for="floatingInputGroup1">Adresse mail</label>
  </div>
          <div class="invalid-feedback">
            ' . $error . '
  </div>
</div>
              <input type="hidden" name="step" value="2">
              <button class="btn btn-lg btn-primary btn-block mt-4" type="submit">Continuer</button>
            </form>
            <p>Etape 1/3</p>
          </div>
        </div>
                              <span>Déjà un compte ? <a href="login.php">Connecte toi maintenant !</a></span>
      </div>
  ';
    } else if($index == 2) {
        $email = htmlspecialchars($_POST['email']);
        $username = htmlspecialchars($_POST['username']);

        echo '
        <div class="card mt-5">
          <div class="card-body">
            <div class="text-center">

              <img src="assets/system/icon.svg" alt="logo" class="mb-3" width="72" height="72">
              <h1 class="h3 mb-3">Sécurisation</h1>
            </div>
            <form method="post" action="register.php">
<div class="input-group mb-3">
    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
  <div class="form-floating ' . needClass($error, 'mots de passe') . '">
    <input type="password" class="form-control ' . needClass($error, 'mots de passe') . '" id="floatingInputGroup1" placeholder="Mot de passe" name="password">
    <label for="floatingInputGroup1">Mot de passe</label>
  </div>
          <div class="invalid-feedback">
            ' . $error . '
  </div>
</div>
<div class="input-group mb-3">
    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
  <div class="form-floating ' . needClass($error, 'mots de passe') . '">
    <input type="password" class="form-control ' . needClass($error, 'mots de passe') . '" id="floatingInputGroup1" placeholder="Mot de passe" name="password_confirm">
    <label for="floatingInputGroup1">Confirmation du mot de passe</label>
  </div>
          <div class="invalid-feedback">
            ' . $error . '
  </div>
</div>
				<input type="hidden" name="email" value="' . $email . '">
				<input type="hidden" name="username" value="' . $username . '">
				              <input type="hidden" name="step" value="3">
              <button class="btn btn-lg btn-primary btn-block mt-4" type="submit">Continuer</button>
              
            </form>
                                    <p>Etape 2/3</p>
          </div>
        </div>
		';
    } else if($index == 3) {
        $email = htmlspecialchars($_POST['email']);
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        echo '
        <div class="card mt-5">
          <div class="card-body">
            <div class="text-center">

              <img src="assets/system/icon.svg" alt="logo" class="mb-3" width="72" height="72">
              <h1 class="h3 mb-3">Vérification</h1>
            </div>
            <form method="post" action="register.php">
            
<div class="form-floating mb-3">
  <input type="text" name="username" readonly class="form-control-plaintext" id="floatingPlaintextInput" value="' . $username . '">
  <label for="floatingPlaintextInput">Nom d\'utilisateur</label>
</div>
<div class="form-floating mb-3">
  <input type="email" name="email" readonly class="form-control-plaintext" id="floatingPlaintextInput" value="' . $email . '">
  <label for="floatingPlaintextInput">Adresse mail</label>
</div>
<div class="form-floating mb-3">
  <input type="password" name="password" readonly class="form-control-plaintext" id="floatingPlaintextInput" value="' . $password . '">
  <label for="floatingPlaintextInput">Mot de passe</label>
</div>
<div class="form-check" style="text-align: left;">
  <input class="form-check-input ' . needClass($error, 'conditions') . '" type="checkbox" name="acceptTOS" id="flexCheckDefault">
  <label class="form-check-label" for="flexCheckDefault">
    J\'accepte les <a href="#">conditions d\'utilisation de Beepot</a>.
  </label>
  
</div>
              <input type="hidden" name="step" value="4">
              <button class="btn btn-lg btn-primary btn-block mt-4" type="submit">Valider</button>
            </form>
            <p>Etape 3/3</p>
          </div>
        </div>';
    }
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
require parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/utils/imports.php";
require parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/utils/handleErrors.php";
require parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/manager/user.php";

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