<link rel="stylesheet" type="text/css" href="/css/header.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="./../js/header.js"></script>


<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
  



<div class="navbar">
    <a class="home" href="./../pages/home.php">Home</a>

    <div class="ui-widget" style="float: left; padding-left: 45%">
        <input id="tags"><i class="fa fa-search" aria-hidden="true" style="color: white;"></i>
    </div>

    <?php if(isset($_SESSION['roles']) && in_array("ROLE_USER", $_SESSION['roles'])){ ?>
    <div class="dropdown">
        <button class="dropbtn"><?php echo $_SESSION['user']; ?> 
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdown-content">
            <a href="./../pages/cont.php">Contul meu</a>
            <a href="./../php/logoutPHP.php">Logout</a>
        </div>
    </div> 
    <?php } ?>
    <?php if(!isset($_SESSION['idUser'])){?>
    <a href="./../pages/login.php">Autentificare</a>
    <?php } ?>


    <?php if(isset($_SESSION['roles']) && in_array("ROLE_MARKETING", $_SESSION['roles'])){?>
    <a href="./../pages/statistics.php">Statistici</a>
    <?php } ?>
    <?php if(isset($_SESSION['roles']) && in_array("ROLE_ADMIN", $_SESSION['roles'])){?>
    <a href="./../pages/conturi.php">Administrare conturi</a>
    <?php } ?>
    
</div>

<script>
    resp(document.getElementById("tags"));         
</script>

