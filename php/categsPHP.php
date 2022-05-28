<?php 
require 'alert.php';
$con=mysqli_connect('localhost','root','','pamwcd');

if(!$con){
    die(' Please Check Your Connection');
}
$msg = "";
$page = "";
session_start();
if(isset($_GET['q']) && $_GET['q'] == 'display')
{


    $query="select den from categ";
    
    $result=mysqli_query($con,$query);

    $res = "";

    while($row = mysqli_fetch_assoc($result))
    {
        $res .= "<a href=\"./../pages/categ.php?categ={$row['den']}\">{$row['den']}</a>";
    }
    
    echo $res;
    mysqli_close($con);
}

