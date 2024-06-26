<?php
session_start();
// print_r($_SERVER);

$CompanyName = "Architecture";
$user_full_name = "Sandip Kundu";
$URL = "/ott/";



$path = '/ott';
$main_path = explode('?', isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '')[0];
// print_r($main_path);

$file_name = explode($path, $main_path)[1];

// print_r($file_name);
if($file_name == '/')
  if(!isset($_SESSION['is_authentic']) || $_SESSION['is_authentic'] == 0)
    include_once './app_pages/signin.php';
  else {
    include_once './universal/header.php';
    include_once './app_pages/dashboard.php';
    include_once './universal/footer.php';
  }
else if(file_exists('./app_pages/'.$file_name.'.php'))
  if(!isset($_SESSION['is_authentic']) || $_SESSION['is_authentic'] == 0)
    include_once './app_pages/signin.php';
  else {
    include_once './universal/header.php';
    include_once './app_pages/'.$file_name.'.php';
    include_once './universal/footer.php';
  }
else
  include_once './app_pages/page404.php';


?>