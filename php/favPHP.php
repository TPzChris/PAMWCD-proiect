<?php
require 'alert.php';
$con=mysqli_connect('localhost','root','','pamwcd');

if(!$con){
    die(' Please Check Your Connection');
}
$msg = "";
$page = "";
session_start();
if(isset($_POST['fav']))
{

    $vals = explode(",", $_POST['fav']);

    $query="select * from user_prod where id_user = {$_SESSION['idUser']} and id_prod = {$vals[0]}";

    echo $query;

    $result=mysqli_query($con,$query);
    $row = mysqli_fetch_assoc($result);

    if(!$row)
    {
        $query1="insert into user_prod(id_prod, id_user) values({$vals[0]}, {$_SESSION['idUser']})";
    }
    else{
        $query1="delete from user_prod where id_user = {$_SESSION['idUser']} and id_prod = {$vals[0]}";
    }

    mysqli_query($con, $query1);
    
}

header("Location: ./../pages/categ.php?categ={$vals[1]}");

?>