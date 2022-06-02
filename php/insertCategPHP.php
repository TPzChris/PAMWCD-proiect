<?php
require 'alert.php';
$con=mysqli_connect('localhost','root','','pamwcd');

if(!$con){
    die(' Please Check Your Connection');
}
$msg = "";
$page = "";
session_start();
if(isset($_POST['newCateg']))
{

    $query="insert into categ(den) values('{$_POST['newCateg']}')";
    
    echo $query;

    mysqli_query($con, $query);
    
}

    header('Location: ' . $_SERVER['HTTP_REFERER']);

    mysqli_close($con);

?>