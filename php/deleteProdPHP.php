<?php
require 'alert.php';
$con=mysqli_connect('localhost','root','','pamwcd');

if(!$con){
    die(' Please Check Your Connection');
}
$msg = "";
$page = "";
session_start();
if(isset($_POST['submitDelete']) || isset($_POST['submitDeleteFromProdPage']))
{

    if(isset($_POST['submitDeleteFromProdPage'])){
        $query="select c.den from categ c where c.id_categ = (select categ_id from prod where id_prod = '{$_POST['deleteProdId']}')";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($result);
    }

    $query="delete from prod
    where id_prod = '{$_POST['deleteProdId']}'";

    if(!mysqli_query($con, $query)){
        $_SESSION['error'] = "Error description: " . mysqli_error($con);
        echo $_SESSION['error'];
    }

    $query="delete from user_prod
    where id_prod = '{$_POST['deleteProdId']}'";

    if(!mysqli_query($con, $query)){
        $_SESSION['error'] = "Error description: " . mysqli_error($con);
        echo $_SESSION['error'];
    }
}

    if(isset($_POST['submitDeleteFromProdPage'])){
        header("Location:./../pages/categ.php?categ={$row['den']}");
    }else{
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    mysqli_close($con);

?>