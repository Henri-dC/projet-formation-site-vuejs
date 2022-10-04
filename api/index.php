<?php
//Settings for cookies

session_set_cookie_params(["SameSite" => "None"]); //none, lax, strict
session_set_cookie_params(["Secure" => "true"]); //false, true
session_set_cookie_params(["HttpOnly" => "true"]); //false, true
ini_set("SMTP","localhost");
ini_set("smtp_port","25");
//Session

session_start();

//Settings for PHP errors

error_reporting(E_ALL);
ini_set('display_errors', 1);

//Settings for header

header('Access-Control-Allow-Origin: http://localhost:5173');
header('Access-Control-Allow-Methods: PUT, DELETE, GET, POST');
header('Access-Control-Allow-Credentials: true');

require 'autoload.php';

if(isset($_FILES['photo'])){
   $loading = new ImageApiControler;
   $loading->loadImg($_FILES['photo']);
}


$api = new Api();
$api->init();
