<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="/css/categ.css" />

</head>

<script>

let showImage = (event) => {
    var image = document.getElementById('imageProd');
	image.src = URL.createObjectURL(event.target.files[0]);
    image.value = URL.createObjectURL(event.target.files[0]);
    document.getElementById('imgTypeProd').value= event.target.files[0].type;
    console.table(document.getElementById('imgFileProd'));
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
if(isset($_GET['categ']))
{
    $query="select p.* from prod p
    where p.categ_id = (select id_categ from categ where den = '{$_GET['categ']}' limit 1)";
    
    if(isset($_POST['order'])){
        $query .= " order by p.denumire {$_POST['order']}";
    }

    $result=mysqli_query($con,$query);

    $prods = array();

    while($row = mysqli_fetch_assoc($result))
    {
        array_push($prods, $row);
    }
}


?>



<body style="background-color: #717171;">

    <div style="margin-left: 20%;">
        <h2><?php echo $_GET['categ']; ?></h2>
        <?php if(isset($_SESSION['roles']) && in_array("ROLE_ADMIN", $_SESSION['roles'])){?>
        <button type="submit" name="insert" class="btn btn-primary" data-toggle="modal" data-target="#insertModal">
            <i class="fa fa-plus" aria-hidden="true"></i>
        </button>

        <div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Inserare produs</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="./../php/insertProdPHP.php" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                            <label for="denProd" class="col-form-label">Denumire:</label>
                            <input type="text" class="form-control" name="updateProdDen" id="denProd">
                            <label for="prodProd" class="col-form-label">Producător:</label>
                            <input type="text" class="form-control" name="updateProdProd" id="prodProd">
                            <label for="stocProd" class="col-form-label">Stoc:</label>
                            <input type="number" min="0" max="100" class="form-control" name="updateProdStoc" id="stocProd">
                            <label for="pretProd" class="col-form-label">Preț:</label>
                            <input type="number" step="any" min="0" class="form-control" name="updateProdPret" id="pretProd">
                            <label for="dataProd" class="col-form-label">Data apariției:</label>
                            <input type="date" class="form-control" name="updateProdData" id="dataProd">
                            <label for="imageProd" class="col-form-label">Imagine:</label>
                            <input type="file" class="col-form-btn" name="updateProdImgFile" id="imgFileProd" onchange="showImage(event)">
                            <input type="image" class="form-control" name="updateProdImg" id="imageProd">
                            <label for="descProd" class="col-form-label">Descriere:</label>
                            <input type="text" class="form-control" name="updateProdDesc" id="descProd">
                            <input type="hidden" name="prodImgType" id="imgTypeProd">
                            <input type="hidden" name="prodCateg" id="imgTypeProd" value="<?php echo $_GET['categ'] ?>">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Anulează</button>
                            <button type="submit button" class="btn btn-primary" name="submitInsert">Confirmă</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <?php } ?>
    </div>

    <hr>

    <div class="main-div">

        <?php foreach($prods as $prod){ ?>
        <!-- <div class="container">
            <div class="item-list">
                <div class="item item-1">
                <div class="img"><a href="javascript:;">
                    <div class="like"><i class="fa fa-heart" aria-hidden="true"></i></div></a>
                    <div class="img-content"></div>
                </div>
                <div class="social"><a href="javascript:;">
                    <div class="text-container">
                        <h2 class="title"><?php echo $prod['denumire']; ?></h2>
                        <div class="content">
                        <p><?php echo $prod['descriere']; ?></p>
                        </div>
                        <div class="readmore">
                        <h3>Mai mult</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <?php



        $likedStatus = "danger"; 
        if(!(isset($_SESSION['roles']) && count($_SESSION['roles']) > 0)){
            $disabled = "disabled"; 
        }
        else{
            $query="select * from user_prod where id_user = {$_SESSION['idUser']} and id_prod = {$prod['id_prod']}";

            $result=mysqli_query($con,$query);
            $row = mysqli_fetch_assoc($result);
            if(!$row){
                $likedStatus = "danger"; 
            }
            else{
                $likedStatus = "secondary";
            }
            $disabled = "";
        }

        ?>
        <div class="row">
            <div class="col">
                <div class="card" style="width: 22rem;">
                    <img class="card-img-top" src="data:image/<?php echo $prod['imagine_content_type']; ?>;base64,<?php echo base64_encode($prod['imagine']) ?>" height="200rem" width="relative" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $prod['denumire']; ?></h5>
                        <p class="card-text"><?php echo $prod['descriere']; ?></p>
                        <p class="card-footer"><?php echo $prod['pret']; ?> RON</p>
                        <a href="./../pages/product.php?prod=<?php echo $prod['denumire']; ?>" class="btn btn-primary">Detalii produs</a>
                        <form method="post" action="./../php/favPHP.php">
                            <button type="submit" name="fav" class="btn btn-<?php echo $likedStatus; ?>" <?php echo $disabled; ?> value="<?php echo $prod['id_prod'].",".$_GET['categ']; ?>">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                            </button>
                        </form>

                        <?php if(isset($_SESSION['roles']) && in_array("ROLE_ADMIN", $_SESSION['roles'])){?>


                        <form method="delete" action="./../php/deleteProdPHP.php">
                            <button type="submit" name="delete" class="btn btn-danger" value="<?php echo $prod['id_prod']; ?>">
                                <i class="fa fa-x" aria-hidden="true"></i>
                            </button>
                        </form>

                        <!-- <form method="patch" action="./../php/updateProdPHP.php"> -->
                            <button type="submit" name="update" class="btn btn-primary" value="<?php echo $prod['id_prod']; ?>" data-toggle="modal" data-target="#updateModal">
                                <i class="fa fa-refresh" aria-hidden="true"></i>
                            </button>
                        <!-- </form> -->

                        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Modificare produs</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="./../php/updateProdPHP.php" method="patch">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="denProd" class="col-form-label">Denumire:</label>
                                                <input type="text" class="form-control" name="updateProdDen" id="denProd" value="<?php echo $prod['denumire']; ?>">
                                                <label for="prodProd" class="col-form-label">Producător:</label>
                                                <input type="text" class="form-control" name="updateProdProd" id="prodProd" value="<?php echo $prod['producator']; ?>">
                                                <label for="stocProd" class="col-form-label">Stoc:</label>
                                                <input type="number" min="0" max="100" class="form-control" name="updateProdStoc" id="stocProd" value="<?php echo $prod['stoc']; ?>">
                                                <label for="pretProd" class="col-form-label">Preț:</label>
                                                <input type="number" step="any" min="0" class="form-control" name="updateProdPret" id="pretProd" value="<?php echo $prod['pret']; ?>">
                                                <label for="dataProd" class="col-form-label">Data apariției:</label>
                                                <input type="date" class="form-control" name="updateProdData" id="dataProd" value="<?php echo $prod['data_aparitiei']; ?>">
                                                <label for="imageProd" class="col-form-label">Imagine:</label>
                                                <input type="file" class="col-form-btn" name="updateProdImgFile" id="imgFileProd" onchange="showImage(event)">
                                                <input type="image" class="form-control" name="updateProdImg" id="imageProd" src="data:image/<?php echo $prod['imagine_content_type']; ?>;base64,<?php echo base64_encode($prod['imagine']) ?>">
                                                <label for="descProd" class="col-form-label">Descriere:</label>
                                                <input type="text" class="form-control" name="updateProdDesc" id="descProd" value="<?php echo $prod['descriere']; ?>">
                                                <input type="hidden" name="prodId" value="<?php echo $prod['id_prod']; ?>">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Anulează</button>
                                            <button type="submit button" class="btn btn-primary">Confirmă</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- <div class="dropdown show">
                            <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-refresh" aria-hidden="true"></i>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal_<?php echo $prod['id_prod']; ?>"><?php echo $prod['denumire']; ?></a>
                            </div>
                        </div>

                        <div class="dropdown show">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <form action="./../php/insertProdPHP.php" method="post">
                                    <input type=text class="dropdown-item custom-submit" name="newCateg">
                                </form>   
                            </div>
                        </div> -->

                        <?php } ?>


                    </div>
                </div>
            </div>
        </div>
        <br>
        <?php } ?>

          


        <?php if(count($prods) == 0) { ?>
        <div>
        <span style="color: yellow">
            <i class="fa-solid fa-7x fa-exclamation-triangle"></i>
        </span>
        <h1>Nu există produse în această categorie...</h1>
        </div>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <?php } ?>
    </div>

    <?php if(count($prods) > 0) { ?>
    <div class="filter-div">
        <h1><b>Ordonare după nume:</b></h1>
        <form method="post" action="./../pages/categ.php?categ=<?php echo $_GET['categ'] ?>">
            <button type="submit" name="order" class="btn btn-primary" value="asc">Ascendent</button>
            <button type="submit" name="order" class="btn btn-secondary" value="desc">Descendent</button>
        </form>
    </div> 
    <?php } 
    unset($_POST['fav']);
    mysqli_close($con);

    ?>

</body>

</html> 