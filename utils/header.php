<link rel="stylesheet" type="text/css" href="/css/header.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<!-- <?php

    // require './../php/alert.php';
    // $con=mysqli_connect('localhost','root','','pamwcd');

    // if(!$con){
    //     die(' Please Check Your Connection');
    // }
    // $msg = "";
    // $page = "";

    // $query="select * from prod";
        
    // $result=mysqli_query($con,$query);

    // $prods = array();

    // if($row = mysqli_fetch_assoc($result))
    // {
    //     array_push($prods, $row);
    // }

?> -->


<div class="navbar">
    <a class="home" href="./../pages/home.php">Home</a>

    <div class="search-container">
        <input type="text" placeholder="Search.." name="search" id="search">
        <button type="submit"><i class="fa fa-search"></i></button> 
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
