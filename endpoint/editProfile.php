<?php
include_once(parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/utils/handleErrors.php");

require parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/manager/user.php";
$id = $getUser()->id;
$name = "";
$bio = "";
$iconInput = null;
$bannerInput = null;

if(isset($_POST['name'])) {
    $name = htmlspecialchars($_POST['name']);
    if(strlen($name) == 0) {
        return;
    }
}
var_dump($_POST);
var_dump($_FILES);
if(isset($_POST['bio'])) {
    $bio = htmlspecialchars($_POST['bio']);
}
if(isset($_FILES["icon"])) {
    $file = $_FILES["icon"];
    $file_ext=strtolower(end($file_split));
    $iconInput = uniqid() . "." . $file_ext;
    move_uploaded_file($file["tmp_name"],parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/assets/uploads/" . $filename);
}

if(isset($_FILES["banner"])) {
    $file = $_FILES["banner"];
    $file_ext=strtolower(end($file_split));
    $bannerInput = uniqid() . "." . $file_ext;
    move_uploaded_file($file["tmp_name"],parse_ini_file(dirname(__DIR__).'/.env')['DOC_ROOT']."/assets/uploads/" . $filename);
}
$updateUser($id, $name, $bio, $iconInput, $bannerInput);

header("Location: ../profil.php?id=".$id);
