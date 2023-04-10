<?php
require "./utils/bdd.php";
$bdd = initBDD();

session_start();
$createUser = function($email, $password, $username) use ($bdd) {
    try {
        $request = $bdd->prepare("INSERT INTO user (username, displayName, email, password, bio) VALUES (:username, :username, :email, :password, :bio)");
        $request->execute(['email' => $email, 'password' => password_hash($password, PASSWORD_BCRYPT), 'bio' => 'Je viens d\'arriver ici, bonjour !', 'username' => $username]);
        return null;
    }catch (Exception $e) {
        return $e->getMessage();
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