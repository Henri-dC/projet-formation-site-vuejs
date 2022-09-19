<?php

session_set_cookie_params(["SameSite" => "None"]); //none, lax, strict
session_set_cookie_params(["Secure" => "true"]); //false, true
session_set_cookie_params(["HttpOnly" => "true"]); //false, true

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Credentials: true');

require 'autoload.php';

if(isset($_FILES['photo'])){
    $tmpName = $_FILES['photo']['tmp_name'];
    $name = $_FILES['photo']['name'];
    $size = $_FILES['photo']['size'];
    $error = $_FILES['photo']['error'];
    if(move_uploaded_file($tmpName, '../src/assets/images/'.$name));
    die();
}


$api = new Api();
$api->init();
