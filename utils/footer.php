<?php
$con=mysqli_connect('localhost','root','','pamwcd');

if(!$con){
    die(' Please Check Your Connection');
}
$query="select * from key_value where `key` in ('relatii_cu_clientii', 'mail')";
    
$result=mysqli_query($con,$query);

$keyVals = array();

while($row = mysqli_fetch_assoc($result))
{
    array_push($keyVals, $row['val']);
}
?>

<footer>
    <link rel="stylesheet" type="text/css" href="/css/footer.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">

    <div class="content">
        <div class="left box">
        <div class="upper">
            <div class="topic">Despre noi</div>
            <p>Proiect PAMWCD.</p>
        </div>
        <div class="lower">
            <div class="topic">Contacteaza-ne</div>
            <div class="phone">
            <a href="#"><i class="fas fa-phone-volume"></i><?php echo $keyVals[0]; ?></a>
            </div>
            <div class="email">
            <a href="#"><i class="fas fa-envelope"></i><?php echo $keyVals[1]; ?></a>
            </div>
        </div>
        </div>
        <div class="middle box">
        <div class="topic">Servicii oferite</div>
        <div><a href="#">Vizualizare produse</a></div>
        <div><a href="#">Vizualizare oferte</a></div>
        <div><a href="#">Lista de favorite</a></div>
        </div>
        <div class="right box">
        <div class="topic">Subscribe</div>
        <form action="#">
            <input type="text" placeholder="Enter email address">
            <input type="submit" name="" value="Send">
            <div class="media-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </form>
        </div>
    </div>
</footer>

