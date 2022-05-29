<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="/css/categ.css" />

</head>


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
        <h2><?php echo $_GET['categ']; ?></h3>
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
                        <a href="./../pages/prod.php?id=<?php echo $prod['id_prod']; ?>" class="btn btn-primary">Detalii produs</a>
                        <form method="post" action="./../php/favPHP.php">
                            <button type="submit" name="fav" class="btn btn-<?php echo $likedStatus; ?>" <?php echo $disabled; ?> value="<?php echo $prod['id_prod'].",".$_GET['categ']; ?>">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <?php } ?>

          


        <?php if(count($prods) == 0) { ?>
        <div>
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