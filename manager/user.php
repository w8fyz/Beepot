<?php
include_once("./utils/bdd.php");
$bdd = initBDD();
if(session_status() != 2) {
    session_start();
}
$createUser = function($email, $password, $username) use ($bdd) {
    try {
        $request = $bdd->prepare("INSERT INTO user (username, displayName, email, password, bio) VALUES (:username, :username, :email, :password, :bio)");
        $request->execute(['email' => $email, 'password' => password_hash($password, PASSWORD_BCRYPT), 'bio' => 'Je viens d\'arriver ici, bonjour !', 'username' => $username]);
        return null;
    }catch (Exception $e) {
        return $e->getMessage();
    }
};

$isLogged = function () use ($bdd){
  if(isset($_SESSION['user_id'])) {
      $id = $_SESSION['user_id'];
      $request = $bdd->prepare("SELECT * FROM user WHERE id = :id");
      $request->execute(['id' => $id]);
      if($request->rowCount()>0) {
          return true;
      } else {
          $logOut();
          return false;
      }
  }
  return false;
};

$logOut = function () use ($bdd) {
  $_SESSION['user_id'] = null;
};

$setLogged = function ($id) use ($bdd) {
  $_SESSION['user_id'] = $id;
};

$getExactUser = function ($email) use ($bdd) {
    $request = $bdd->prepare("SELECT * FROM user WHERE email = :email");
    $request->execute(['email' => $email]);;
    if($request->rowCount()>0) {
        return $request->fetch(PDO::FETCH_OBJ);
    } else {
        return null;
    }
};

$getUserById = function ($id) use ($bdd) {
    $request = $bdd->prepare("SELECT * FROM user WHERE id = :id");
    $request->execute(['id' => $id]);
    return $request->fetch(PDO::FETCH_OBJ);
};

$getUser = function () use ($bdd) {
    if(isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
        $request = $bdd->prepare("SELECT * FROM user WHERE id = :id");
        $request->execute(['id' => $id]);
        return $request->fetch(PDO::FETCH_OBJ);
    }
};

$isEmailUsed = function ($email) use ($bdd) {
    try {
        $request = $bdd->prepare("SELECT * FROM user WHERE UPPER(email) = UPPER(:email)");
        $request->execute(['email' => $email]);
        return ($request->rowCount()>0);
    }catch (Exception $e) {
        echo $e;
        return true;
    }
};

$isUsernameUsed = function ($username) use ($bdd) {
    try {
        $request = $bdd->prepare("SELECT * FROM user WHERE UPPER(username) = UPPER(:username)");
        $request->execute(['username' => $username]);
        return ($request->rowCount()>0);
    }catch (Exception $e) {
        return true;
    }
};

?>