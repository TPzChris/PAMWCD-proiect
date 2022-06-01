<?php
require 'alert.php';
$con=mysqli_connect('localhost','root','','pamwcd');

if(!$con){
    die(' Please Check Your Connection');
}
$msg = "";
$page = "";
session_start();
if(isset($_POST['updateCateg']))
{

    $query="update categ set den = '{$_POST['updateCateg']}' where id_categ = {$_POST['categId']}";

    mysqli_query($con, $query);
    
}

    header('Location: ' . $_SERVER['HTTP_REFERER']);

    mysqli_close($con);

?>