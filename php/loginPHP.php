<?php 
require 'alert.php';
$con=mysqli_connect('localhost','root','','pamwcd');

if(!$con){
    die(' Please Check Your Connection');
}
$msg = "";
$page = "";
session_start();
if(isset($_POST['Login']))
{

    $flagOK = false;

    $query="select * from user where name='".$_POST['username']."' and pass='".$_POST['password']."'";
    
    $result=mysqli_query($con,$query);

    if($row = mysqli_fetch_assoc($result))
    {
        $_SESSION['idUser'] = $row['id_user'];
        $_SESSION['user'] = $_POST['username'];
        $flagOK = true;
    }
    else
    {
        $msg = "Utilizator inexistent";
        $page = "./../pages/login.php?Invalid=Failed-Auth";
        phpAlert($msg, $page);
    }

    $query="select a.name from user_authority ua, authority a where ua.id_authority = a.id_authority and ua.user_id=".$_SESSION['idUser'];

    $result=mysqli_query($con,$query);

    $roles = array();

    while($row = mysqli_fetch_assoc($result))
    {
        echo $row['name'];
        echo "BREAK \n";

        array_push($roles, $row['name']);
        $flagOK = true;
    }
    $_SESSION['roles'] = $roles;
    
    mysqli_close($con);

    if($flagOK){
        header("location:./../pages/home.php");
    }

}
else{
    
    $msg = "Eroare";
    $page = "./../pages/login.php?Invalid=Error";
    phpAlert($msg, $page);
}
