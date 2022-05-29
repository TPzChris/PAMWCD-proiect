<?php 
require 'alert.php';
$con=mysqli_connect('localhost','root','','pamwcd');

if(!$con){
    die(' Please Check Your Connection');
}
$msg = "";
$page = "";
session_start();
if(isset($_GET['prods']) && $_GET['prods'] == 'display')
{
    $query="select denumire from prod";
    
    $result=mysqli_query($con,$query);

    $res = array();

    while($row = mysqli_fetch_assoc($result))
    {
        array_push($res, $row['denumire']);
    }

    echo json_encode($res);
    
    mysqli_close($con);
}

