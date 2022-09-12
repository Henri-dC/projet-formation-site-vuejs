<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Access-Control-Allow-Origin: http://127.0.0.1:5173');
header('Access-Control-Allow-Methods: *');
header('Access-Control-Allow-Credentials: true');
require 'autoload.php';

if(isset($_FILES['photo'])){
    $tmpName = $_FILES['photo']['tmp_name'];
    $name = $_FILES['photo']['name'];
    $size = $_FILES['photo']['size'];
    $error = $_FILES['photo']['error'];
    if(move_uploaded_file($tmpName, '../src/assets/images/'.$name));

    
}
    



$api = new Api();
$api->init();
