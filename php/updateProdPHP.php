<?php
require 'alert.php';
$con=mysqli_connect('localhost','root','','pamwcd');

if(!$con){
    die(' Please Check Your Connection');
}
$msg = "";
$page = "";
session_start();
if(isset($_POST['submitUpdate']))
{
    $queryString = "";
    if(!empty($_FILES['updateProdImgFile']['tmp_name']) && file_exists($_FILES['updateProdImgFile']['tmp_name'])){

        $imgContent = addslashes(file_get_contents($_FILES['updateProdImgFile']['tmp_name']));
        $queryString =
        "
        imagine = '{$imgContent}', 
        imagine_content_type = '{$_POST['updateProdImgType']}',";
        
    }


    $query="update prod set 
    denumire = '{$_POST['updateProdDen']}', 
    descriere = '{$_POST['updateProdDesc']}', 
    stoc = {$_POST['updateProdStoc']},
    data_aparitiei = STR_TO_DATE('{$_POST['updateProdData']}','%Y-%m-%d'), 
    {$queryString}
    pret = {$_POST['updateProdPret']}, 
    producator = '{$_POST['updateProdProd']}'
    where id_prod = '{$_POST['updateProdId']}'";

    if(!mysqli_query($con, $query)){
        $_SESSION['error'] = "Error description: " . mysqli_error($con);
        echo $_SESSION['error'];
    }
    
}

    header('Location: ' . $_SERVER['HTTP_REFERER']);

    mysqli_close($con);

?>