<?php
error_reporting(E_ALL);
error_reporting(-1);
ini_set('error_reporting', E_ALL);

session_start();
session_destroy();
header('location: index.php');
?>