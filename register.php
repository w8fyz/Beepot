<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="css/register.css">
</head>
<body>

<?php
require "utils/imports.php";
require "utils/handleErrors.php";
require "manager/user.php";


function needClass($error, $needed) {
    if(strpos($error, $needed)) {
        return "is-invalid";
    }
    return "";
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
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card mt-5">
          <div class="card-body">
            <div class="text-center">
                        <p>Etape 1/3</p>
              <img src="assets/system/icon.svg" alt="logo" class="mb-3" width="72" height="72">
              <h1 class="h3 mb-3">Beepot - Inscription</h1>
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
          </div>
        </div>
      </div>
    </div>
  </div>
  ';
    } else if($index == 2) {
        $email = htmlspecialchars($_POST['email']);
        $username = htmlspecialchars($_POST['username']);

        echo '
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card mt-5">
          <div class="card-body">
            <div class="text-center">
                        <p>Etape 2/3</p>
              <img src="assets/system/icon.svg" alt="logo" class="mb-3" width="72" height="72">
              <h1 class="h3 mb-3">Beepot - Inscription</h1>
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
          </div>
        </div>
      </div>
    </div>
  </div>
		';
    } else if($index == 3) {
        $email = htmlspecialchars($_POST['email']);
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        $displayName = "";
        $bio = "";

        if(isset($_POST['displayName'])) {
            $displayName = htmlspecialchars($_POST['displayName']);
        }
        if(isset($_POST['bio'])) {
            $bio = htmlspecialchars($_POST['bio']);
        }

        echo '<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card mt-5">
          <div class="card-body">
            <div class="text-center">
                        <p>Etape 3/3</p>
              <img src="assets/system/icon.svg" alt="logo" class="mb-3" width="72" height="72">
              <h1 class="h3 mb-3">Beepot - Inscription</h1>
            </div>
            <form method="post" action="register.php">
              <div class="form-group">
                <label for="displayName">Nom d\'affichage</label>
                <input value="' . $username . '" type="text" name="displayName" value="' . $displayName . '" class="form-control" required>
              </div>
                            <div class="form-group">
                <label for="bio">Bio</label>
                <textarea name="bio" class="form-control" required>' . $bio . '</textarea>
              </div>
				<input type="hidden" name="email" value="' . $email . '">
				<input type="hidden" name="username" value="' . $username . '">
				<input type="hidden" name="password" value="' . $password . '">
              <input type="hidden" name="step" value="4">
              <button class="btn btn-lg btn-primary btn-block mt-4" type="submit">Valider</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>';
    }
}


if(!isset($_POST['step'])) {

    getForm(1, "");

} else if ($_POST['step'] == 2) {

    $email = htmlspecialchars($_POST['email']);
    $username = htmlspecialchars($_POST['username']);

    if(strlen($email) > 360 || !preg_match("/^[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)*@[a-zA-Z0-9]+(?:\.[a-zA-Z0-9]+)*$/", $email)) {
        getForm(1, "L'email est invalide");
        return;
    }

    if(!preg_match("/^[A-Za-z0-9_-]{3,35}$/", $username)) {
        getForm(1, "Le nom d'utilisateur est invalide");
        return;
    }
    if($isEmailUsed($email)) {
        getForm(1, "Email déjà utilisée");
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

    $displayName = htmlspecialchars($_POST['displayName']);
    $bio = htmlspecialchars($_POST['bio']);

    if(strlen($bio) > 500) {
        getForm(3, "La bio est trop longue.");
        return;
    }

    if(strlen($displayName) > 50) {
        getForm(3, "Le nom d'affichage est trop long.");
        return;
    }
    if($isEmailUsed($email)) {
        getForm(3, "Email déjà utilisée");
        return;
    }

    if($isUsernameUsed($username)) {
        getForm(3, "Nom d'utilisateur déjà utilisée");
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
</body>
</html>