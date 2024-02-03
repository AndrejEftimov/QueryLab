<?php 

session_start();

require "../app/core/init.php";

DEBUG ? ini_set('display_errors', 1) : ini_set('display_errors', 0);

create_database(); //create database if it doesn't exist

$app = new App;
$app->loadController();
