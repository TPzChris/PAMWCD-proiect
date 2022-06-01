<?php
require 'alert.php';
$con=mysqli_connect('localhost','root','','pamwcd');

if(!$con){
    die(' Please Check Your Connection');
}
$msg = "";
$page = "";
session_start();
if(isset($_POST['submitDelete']))
{
    $query="delete from prod
    where id_prod = '{$_POST['deleteProdId']}'";

    if(!mysqli_query($con, $query)){
        $_SESSION['error'] = "Error description: " . mysqli_error($con);
        echo $_SESSION['error'];
    }
    
}

    header('Location: ' . $_SERVER['HTTP_REFERER']);

    mysqli_close($con);

?>