<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="/css/admin.css" />

<?php 
require './../php/alert.php';
require './../pojo/user.php';
$con=mysqli_connect('localhost','root','','pamwcd');

if(!$con){
    die(' Please Check Your Connection');
}
$msg = "";
$page = "";
$row = null;
$query="select u.id_user, u.name, u.email from user u";

$result=mysqli_query($con,$query);

$users = array();
while($row = mysqli_fetch_assoc($result)){
    $user = new User();
    $user->set_id($row['id_user']);
    $user->set_name($row['name']);
    $user->set_email($row['email']); 
    array_push($users, $user);
}

foreach($users as $user){
  $query="select a.name from authority a, user_authority ua 
  where ua.id_authority = a.id_authority
  and ua.user_id = {$user->get_id()}";

  $result=mysqli_query($con,$query);

  $roles = array();
  while($row = mysqli_fetch_assoc($result)){
    array_push($roles, $row['name']);
  }

  $user->set_roles($roles);
}


?>

</head>
<body style="background-color: #717171;">

<?php
if(isset($_SESSION['error'])){
?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <h3><?php echo $_SESSION['error']; ?></h3>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div> 
<?php     
    unset($_SESSION['error']);
}
?>

  <div class="main-div">

    <?php if(!(isset($_SESSION['roles']) && in_array("ROLE_ADMIN", $_SESSION['roles']))){ ?>

      <div>
        <span style="color: red">
          <i class="fa-solid fa-7x fa-exclamation-triangle"></i>
        </span>
        <h1>Oops...</h1>
      </div>
      <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    <?php }else{ ?>

      <div style="margin-left: 20%;">
          <h2>Utilizatori</h3>
      </div>
      <hr>
      <br>
      <div class="main-div">

        <?php foreach($users as $user){ ?>
          
          <div class="card w-100" style="width: 20rem;">
            <div class="card-body">
              <h2 class="card-title"><a href="./../pages/account.php?id=<?php echo $user->get_id(); ?>" style="text-decoration: none; color: inherit;"><?php echo $user->get_name(); ?></a></h2>
              <p class="card-text"><?php echo $user->get_email(); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
              <button type="button" class="btn btn-warning" style="display: inline-block">User</button>
              <form method="post" action="./../php/changeRolePHP.php" style="display: inline-block">
                <input type="hidden" name="userId" value="<?php echo $user->get_id(); ?>">
                <button type="button submit" name="submitRoleChange" class="btn btn-<?php if(!in_array("ROLE_ADMIN", $user->get_roles())){ ?>outline-<?php } ?>primary" value="admin">Admin</button>
              </form>
            </div>
          </div>
        
        <?php } ?>

          
      </div>
          <br><br><br>
      <?php
      }
      mysqli_close($con);
      ?>
  </div>
  </body>

</html> 