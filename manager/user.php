<?php
include_once(parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/utils/handleErrors.php");
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
    $id = "";
    if(isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];
    } else{
        $id = refreshSessionByCookie();
    }
    if($id == null) {
        return false;
    }
      $request = $bdd->prepare("SELECT * FROM user WHERE id = :id");
      $request->execute(['id' => $id]);
      if($request->rowCount()>0) {
          return true;
      } else {
          return false;
      }
  return false;
};



$setLogged = function ($id, $cookie) use ($bdd) {
  $_SESSION['user_id'] = $id;
  if($cookie) {
      include_once(parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/manager/sessionID.php");
      $key = parse_ini_file(dirname(__DIR__).'/.env')['SHA_KEY'];
      $uuid = getUUID();
      $ip = getIp();
      $createUserHash($id, $uuid, $ip);
      setcookie('remember_user', $uuid, time() + 2592000);
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
    $request = $bdd->prepare("SELECT *, TIMESTAMPDIFF(SECOND,'1970-01-01 00:00:00', creationDate) AS creationTimestamp FROM user WHERE id = :id");
    $request->execute(['id' => $id]);
    return $request->fetch(PDO::FETCH_OBJ);
};

if(!function_exists('refreshSessionByCookie')) {
    function refreshSessionByCookie()
    {
        if (isset($_COOKIE['remember_user'])) {
            $cookie = $_COOKIE['remember_user'];
            include_once(parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/manager/sessionID.php");
            $userID = $getUserIDByHash($cookie, getIp());
            if($userID != null) {
                $_SESSION['user_id'] = $userID->idUser;
                return $userID->idUser;
            } else {
                return null;
            }
        }
    }
}
if(!function_exists('getUUID')) {
    function getUUID($data = null) {
        // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
        $data = $data ?? random_bytes(16);
        assert(strlen($data) == 16);

        // Set version to 0100
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        // Set bits 6-7 to 10
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

        // Output the 36 character UUID.
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}
if(!function_exists('getIp')) {
    function getIp() {
        return $_SERVER['HTTP_CLIENT_IP'] ?? ($_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR']);
    }
}

$updateUser = function ($id, $displayName, $bio, $pp, $banner) use ($bdd) {
    $fields = ['displayName' => $displayName, 'bio' => $bio, 'id' => $id];
    $doIaddbanner = "";
    if($banner != null) {
        $doIaddbanner = ", profile_banner = :banner";
        $fields['banner'] = $banner;
    }
    $doIaddpp = "";
    if($pp != null) {
        $doIaddpp = ", profile_picture = :pp";
        $fields['pp'] = $pp;
    }
    $request = $bdd->prepare("UPDATE user SET displayName = :displayName, bio = :bio".$doIaddbanner.$doIaddpp." WHERE id = :id");
    $request->execute($fields);
};

$getUser = function () use ($bdd) {
    if(!isset($_SESSION['user_id'])) {
       $id = refreshSessionByCookie();
       if($id == null) {
           return null;
       }
    } else {
        $id = $_SESSION['user_id'];
    }
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