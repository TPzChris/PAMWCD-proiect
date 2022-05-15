<?php 
require 'alert.php';
$con=mysqli_connect('localhost','root','','pamwcd');

if(!$con){
    die(' Please Check Your Connection');
}
$msg = "";
$page = "";
session_start();
if(isset($_POST['Register']))
{

    $flagOK = false;

    $query="select count(*) as userCount from user where name='".$_POST['username']."' OR email ='".$_POST['email']."'";
    
    $result= mysqli_query($con,$query);

    $row = mysqli_fetch_assoc($result);

    if($row['userCount'] == 0)
    {

        $username = $_POST['username'];
        $pass = $_POST['pass1'];
        $email = $_POST['email'];

        $query = "INSERT INTO user (name, pass, email) VALUES('$username', '$pass', '$email'); ";
  	    mysqli_query($con, $query);

        $query="select * from user where name='".$username."'";

        $result=mysqli_query($con,$query);
    
        if($row = mysqli_fetch_assoc($result))
        {
            echo print_r($row);
            $checkedUser = $row['id_user'];
            $flagOK = true;
        }

        $query = "INSERT INTO user_authority (user_id, id_authority) VALUES ($checkedUser, 5)";
  	    mysqli_query($con, $query);  

        $flagOK = true;
    }
    else
    {
        $msg = "Username sau email folosite";
        $page = "./../pages/register.php?Invalid=Failed-Reg";
        phpAlert($msg, $page);
    }

    
    mysqli_close($con);

    if($flagOK){
        header("location:./../pages/login.php");
    }

}
else{
    
    $msg = "Eroare";
    $page = "./../pages/register.php?Invalid=Error";
    phpAlert($msg, $page);
}
