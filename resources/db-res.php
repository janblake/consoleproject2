<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$dbServername="localhost";
$dbUsername="root";
$dbPassword="";
$dbName="console";

$conn=mysqli_connect($dbServername,$dbUsername,$dbPassword,$dbName);