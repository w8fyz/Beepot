<link rel="shortcut icon" href="./assets/system/icon.svg" type="image/x-icon">

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="css/login.css">
</head>
<body>
<svg viewBox="0 0 500 500" preserveAspectRatio="xMinYMin meet">
    <path d="M0,100 C150,200  350,0 500,100 L500,00 L0,0 Z" style="stroke: none; fill:#DFE9F5FF;"></path>
</svg>
<?php
require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/utils/imports.php";
require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/utils/handleErrors.php";
require parse_ini_file(dirname(__DIR__).'/beepot/.env')['DOC_ROOT']."/manager/user.php";

if($isLogged()) {
    header("Location: index.php");
}

function getForm($error) {
    $password = "";
    $email = "";

    if(isset($_POST['password'])) {
        $password = htmlspecialchars($_POST['password']);
    }
    if(isset($_POST['email'])) {
        $email = htmlspecialchars($_POST['email']);
    }

    echo '        <div class="card mt-5">
          <div class="card-body">
            <div class="text-center">
              <img src="assets/system/icon.svg" alt="logo" class="mb-3" width="72" height="72">
              <h1 class="h3 mb-3">Connexion</h1>
            </div>
            <form method="post" action="login.php">
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
<div class="input-group mb-3">
  <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
  <div class="form-floating ' . needClass($error, 'mot de passe') . '">
    <input type="password" class="form-control ' . needClass($error, 'mot de passe') . '" id="floatingInputGroup1" placeholder="Mot de passe" name="password" value="' . $password . '">
    <label for="floatingInputGroup1">Mot de passe</label>
  </div>
          <div class="invalid-feedback">
            ' . $error . '
  </div>
</div>
<div class="form-check" style="text-align: left;">
  <input class="form-check-input" type="checkbox" name="rememberMe" id="flexCheckDefault" checked>
  <label class="form-check-label" for="flexCheckDefault">
    Se souvenir de moi
  </label>
</div>
              <button class="btn btn-lg btn-primary btn-block mt-4" type="submit">Connexion</button>
            </form>
                          <span>Pas encore de compte ? <a href="register.php">Inscrit toi maintenant !</a></span>
          </div>
        </div>
      </div>';
}

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
            <h1 class="title">De retour sur Beepot ?</h1>
            <p class="subtitle">Partagez votre quotidien, échangez avec vos amis et découvrez les dernières actualités. Rejoignez la communauté Beepot et soyez partout, n'importe où.</p>
        </div>
        <div class="col-md-7">

<?php

if(isset($_POST['email']) && isset($_POST['password'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    if(strlen($email) > 360 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        getForm( "L'email est invalide");
        return;
    }

    $tryUser = $getExactUser($email);
    if($tryUser === NULL || !password_verify($password, $tryUser->password)) {
        getForm("Le mot de passe est incorrect ou aucun compte n'est associé à cet email.");
        return;
    }

    $setLogged($tryUser->id, (isset($_POST['rememberMe']) && $_POST['rememberMe'] == "on"));
    header("Location: index.php?status=loginSuccess");
} else {
    getForm(1);
}
?>

        </div>
    </div>
</div>
</div>

</body>
</html>