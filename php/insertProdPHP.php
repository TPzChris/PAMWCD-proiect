<?php
require 'alert.php';
$con=mysqli_connect('localhost','root','','pamwcd');

if(!$con){
    die(' Please Check Your Connection');
}
$msg = "";
$page = "";
session_start();
if(isset($_POST['submitInsert']))
{

    print_r($_FILES);//['updateProdImgFile']['tmp_name'];

    $imgContent = addslashes(file_get_contents($_FILES['updateProdImgFile']['tmp_name']));

    $query="insert into prod(denumire, descriere, stoc, data_aparitiei, imagine, imagine_content_type, pret, producator, categ_id) 
    values('{$_POST['updateProdDen']}', '{$_POST['updateProdDesc']}', {$_POST['updateProdStoc']}, 
    STR_TO_DATE('{$_POST['updateProdData']}','%Y-%m-%d'), '{$imgContent}', 
    '{$_POST['prodImgType']}', {$_POST['updateProdPret']}, '{$_POST['updateProdProd']}', (select id_categ from categ where den = '{$_POST['prodCateg']}'))";
    
    echo $query;

    mysqli_query($con, $query);
    
}

    //header('Location: ' . $_SERVER['HTTP_REFERER']);

    mysqli_close($con);

?>