<link rel="stylesheet" type="text/css" href="/css/menu.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="./../js/menu.js"></script>


<?php 

include "./../pojo/categ.php";

$con=mysqli_connect('localhost','root','','pamwcd');

if(!$con){
    die(' Please Check Your Connection');
}
$msg = "";
$page = "";

$query="select * from categ";

$result=mysqli_query($con,$query);

$res = array();

while($row = mysqli_fetch_assoc($result))
{
    $category = new Categ();
    $category->set_id($row['id_categ']);
    $category->set_den($row['den']);
    array_push($res, $category);
}


?>

<script>
    $(document).ready(function() {

        $('.custom-submit').keydown(function(event) {
            // enter has keyCode = 13, change it if you want to use another button
            if (event.keyCode == 13) {
                this.form.submit();
                return false;
            }
        });

    });
</script>

<?php if(isset($_SESSION['roles']) && in_array("ROLE_ADMIN", $_SESSION['roles'])){?>

<div class="dropdown show">
    <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="display: inline-block">
        <i class="fa fa-refresh" aria-hidden="true"></i>
    </a>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <?php foreach ($res as $categ){ ?>
        <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal_<?php echo $categ->get_id(); ?>"><?php echo $categ->get_den(); ?></a>
        <?php } ?>
    </div>
</div>

<div class="dropdown show">
    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-plus" aria-hidden="true"></i>
    </a>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <form action="./../php/insertCategPHP.php" method="post">
            <input type=text class="dropdown-item custom-submit" name="newCateg">
        </form>   
    </div>
</div>

<?php } ?>

<div class="dropdown-normal">
    <button class="dropbtn">
        <i class="fa fa-bars" aria-hidden="true"></i>
    </button>
    <div class="dropdown-content" id="categs">
    </div>
</div>

<?php foreach ($res as $categ){ ?>
<div class="modal fade" id="exampleModal_<?php echo $categ->get_id(); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificare categorie</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="./../php/updateCategPHP.php" method="post">
      <div class="modal-body">
        <div class="form-group">
            <label for="recipient-name" class="col-form-label">Denumire:</label>
            <input type="text" class="form-control" name="updateCateg" id="recipient-name" value="<?php echo $categ->get_den(); ?>">
            <input type="hidden" name="categId" value="<?php echo $categ->get_id(); ?>">
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
<?php } ?>
