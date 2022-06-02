<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="/css/product.css" />


<script>

let showImageInsert = (event) => {
    var image = document.getElementById('imageProd');
	image.src = URL.createObjectURL(event.target.files[0]);
    image.value = URL.createObjectURL(event.target.files[0]);
    document.getElementById('imgTypeProd').value= event.target.files[0].type;
    console.table(document.getElementById('imgFileProd'));
}

let showImageUpdate = (event, idProd) => {
    var image = document.getElementById('imageProdUpdate_' + idProd);
	image.src = URL.createObjectURL(event.target.files[0]);
    image.value = URL.createObjectURL(event.target.files[0]);
    document.getElementById('imgTypeProdUpdate_' + idProd).value= event.target.files[0].type;
    console.table(document.getElementById('imgFileProdUpdate_' + idProd));
}

</script>

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
      <?php if(isset($_SESSION['roles']) && in_array("ROLE_ADMIN", $_SESSION['roles'])){?>
      <button type="submit" name="delete" class="btn btn-danger" value="<?php echo $prod['id_prod']; ?>" data-toggle="modal" data-target="#deleteModal">
          <i class="fa fa-x" aria-hidden="true"></i>
      </button>
      <br>

      <button type="submit" name="update" class="btn btn-primary" value="<?php echo $prod['id_prod']; ?>" data-toggle="modal" data-target="#updateModal">
          <i class="fa fa-refresh" aria-hidden="true"></i>
      </button>
      <?php } ?>
      <h2>Descriere: <?php echo $row['descriere']; ?></h2>
    </div>
  </div>

  <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modificare produs</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <form action="./../php/updateProdPHP.php" method="post" enctype="multipart/form-data">
                  <div class="modal-body">
                      <div class="form-group">
                          <label for="denProd" class="col-form-label">Denumire:</label>
                          <input type="text" class="form-control" name="updateProdDen" id="denProd" value="<?php echo $row['denumire']; ?>">
                          <label for="prodProd" class="col-form-label">Producător:</label>
                          <input type="text" class="form-control" name="updateProdProd" id="prodProd" value="<?php echo $row['producator']; ?>">
                          <label for="stocProd" class="col-form-label">Stoc:</label>
                          <input type="number" min="0" max="100" class="form-control" name="updateProdStoc" id="stocProd" value="<?php echo $row['stoc']; ?>">
                          <label for="pretProd" class="col-form-label">Preț:</label>
                          <input type="number" step="any" min="0" class="form-control" name="updateProdPret" id="pretProd" value="<?php echo $row['pret']; ?>">
                          <label for="dataProd" class="col-form-label">Data apariției:</label>
                          <input type="date" class="form-control" name="updateProdData" id="dataProd" value="<?php echo $row['data_aparitiei']; ?>">
                          <label for="imageProd" class="col-form-label">Imagine:</label>
                          <input type="file" class="col-form-btn" name="updateProdImgFile" id="imgFileProdUpdate_<?php echo $row['id_prod']; ?>" onchange="showImageUpdate(event, <?php echo $row['id_prod']; ?>)">
                          <input type="image" class="form-control" name="updateProdImg" id="imageProdUpdate_<?php echo $row['id_prod']; ?>" src="data:image/<?php echo $row['imagine_content_type']; ?>;base64,<?php echo base64_encode($row['imagine']) ?>">
                          <label for="descProd" class="col-form-label">Descriere:</label>
                          <input type="text" class="form-control" name="updateProdDesc" id="descProd" value="<?php echo $row['descriere']; ?>">
                          <input type="hidden" name="updateProdId" value="<?php echo $row['id_prod']; ?>">
                          <input type="hidden" name="updateProdImgType" id="imgTypeProdUpdate_<?php echo $row['id_prod']; ?>" value="<?php echo $row['imagine_content_type']; ?>">
                          <input type="hidden" name="updateProdCateg" id="categProd" value="<?php echo $_GET['categ'] ?>">
                      </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Anulează</button>
                      <button type="submit button" class="btn btn-primary" name="submitUpdateFromProdPage">Confirmă</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Ștergere produs</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <p>Sigur dorești să ștergi produsul cu denumirea <span style="color: red"><?php echo $row['denumire']; ?></span>? </p>
              </div>
              <div class="modal-footer">
                  <form method="post" action="./../php/deleteProdPHP.php">
                      <input type="hidden" name="deleteProdId" value="<?php echo $row['id_prod']; ?>">
                      <button type="button" class="btn btn-primary" data-dismiss="modal">Anulare</button>
                      <button type="button submit" name="submitDeleteFromProdPage" class="btn btn-danger">Confirm</button>
                  </form>
              </div>
          </div>
      </div>
  </div>

<?php } 
mysqli_close($con);
?>

</div>
  

</body>

</html> 