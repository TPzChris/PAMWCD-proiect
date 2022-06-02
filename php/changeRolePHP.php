<?php
require 'alert.php';
$con=mysqli_connect('localhost','root','','pamwcd');

if(!$con){
    die(' Please Check Your Connection');
}
$msg = "";
$page = "";
session_start();
if(isset($_POST['submitRoleChange']))
{
    $role = "";
    switch($_POST['submitRoleChange']){
        case "admin": $role = "ROLE_ADMIN";
    }
    echo $role;

    $query="select count(1) as count from user_authority ua, authority a 
    where ua.id_authority = a.id_authority and ua.user_id = {$_POST['userId']} and a.name = '{$role}'";

    echo $query;

    $result = mysqli_query($con, $query);
    $count = mysqli_fetch_assoc($result);

    if($count['count'] == 0)
    {
        $query1="insert into user_authority(user_id, id_authority) values({$_POST['userId']}, (select a.id_authority from authority a where a.name = '{$role}'))";
    }
    else{
        $query1="delete from user_authority where user_id = {$_POST['userId']} and id_authority = (select a.id_authority from authority a where a.name = '{$role}')";
    }

    echo $query1;

    if(!mysqli_query($con, $query1)){
        $_SESSION['error'] = "Error description: " . mysqli_error($con);
        echo $_SESSION['error'];
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

?>