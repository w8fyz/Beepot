<?php
include_once(parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/utils/bdd.php");
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

$logOut = function () use ($bdd) {
    $_SESSION['user_id'] = null;
    setcookie('remember_user', null, -1);
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



$setLogged = function ($id, $cookie) use ($bdd) {
  $_SESSION['user_id'] = $id;
  if($cookie) {
      $key = parse_ini_file(dirname(__DIR__).'/.env')['SHA_KEY'];
      $value = id.':'.time();
      $hash = hash_hmac('sha256', $value, $key);
      $value = $value.':'.$hash;
      setcookie('remember_user', $value, time() + 2592000);
  }
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

if(!function_exists('refreshSessionByCookie')) {
    function refreshSessionByCookie()
    {
        var_dump($_COOKIE);
        if (isset($_COOKIE['remember_user'])) {
            $cookie = $_COOKIE['remember_user'];
            $key = parse_ini_file(dirname(__DIR__) . '/.env')['SHA_KEY'];
            $parts = explode(':', $cookie);
            $hash = array_pop($parts);
            $value = implode(':', $parts);
            $expected_hash = hash_hmac('sha256', $value, $key);
            if ($hash === $expected_hash) {
                list($user_id, $timestamp) = explode(':', $value);
                if (time() - $timestamp <= 2592000) {
                    $_SESSION['user_id'] = $user_id;
                }
            }
        }
    }
}

$getUser = function () use ($bdd) {
    if(!isset($_SESSION['user_id'])) {
       refreshSessionByCookie();
    }
    $id = $_SESSION['user_id'];
    $request = $bdd->prepare("SELECT * FROM user WHERE id = :id");
    $request->execute(['id' => $id]);
    return $request->fetch(PDO::FETCH_OBJ);
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