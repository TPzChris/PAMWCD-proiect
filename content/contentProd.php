<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="/css/product.css" />

<?php 
require './../php/alert.php';
$con=mysqli_connect('localhost','root','','pamwcd');

if(!$con){
    die(' Please Check Your Connection');
}
$msg = "";
$page = "";
$row = null;
if(isset($_GET['prod']))
{
    $query="select p.* from prod p where p.denumire = '{$_GET['prod']}'";

    $result=mysqli_query($con,$query);

    $row = mysqli_fetch_assoc($result);

}

?>


<?php
  $likedStatus = "danger"; 
  if(!(isset($_SESSION['roles']) && count($_SESSION['roles']) > 0)){
      $disabled = "disabled"; 
  }
  else{
      $query="select * from user_prod where id_user = {$_SESSION['idUser']} and id_prod = {$row['id_prod']}";

      $result=mysqli_query($con,$query);
      $row1 = mysqli_fetch_assoc($result);
      if(!$row1){
          $likedStatus = "danger"; 
      }
      else{
          $likedStatus = "secondary";
      }
      $disabled = "";
  }

?>

</head>
<body style="background-color: #717171;">


<div class="main-div">

<?php if(!$row){ ?>

  <div>
    <span style="color: red">
      <i class="fa-solid fa-7x fa-exclamation-triangle"></i>
    </span>
    <h1>Produsul căutat nu există...</h1>
  </div>
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php }else{ ?>

  <div style="margin-left: 20%;">
      <h2><?php echo $row['denumire']; ?></h3>
  </div>

  <div class="parent">
    <hr>
    <div class="left-div">
      <img class="card-img-top" src="data:image/<?php echo $row['imagine_content_type']; ?>;base64,<?php echo base64_encode($row['imagine']) ?>" height="200rem" width="relative" alt="Card image cap">
    </div>
    <div class="right-div">
      <h3>Producător: <?php echo $row['producator']; ?></h3>
      <h3>Preț: <?php echo $row['pret']; ?></h3>
      <h3>Stoc: <?php echo $row['stoc']; ?></h3>
      <h3>Data apariției: <?php echo $row['data_aparitiei']; ?></h3>
    </div>
    <div class="bottom-div">
      <hr>
      <form method="post" action="./../php/favPHP.php">
          <button type="submit" name="fav" class="btn btn-<?php echo $likedStatus; ?>" <?php echo $disabled; ?> value="<?php echo $row['id_prod'].",_,".$row['denumire']; ?>">
              <i class="fa fa-heart" aria-hidden="true"></i>
          </button>
      </form>
      <h2>Descriere: <?php echo $row['descriere']; ?></h2>
    </div>
  </div>

<?php } 
mysqli_close($con);
?>

</div>
  

</body>

</html> 