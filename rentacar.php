<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "rentacar";

try {
  $conn = new PDO("mysql:host=$servername;dbname=rentacar", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  echo "";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rentacar</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
</head>
<body>

<nav>
    <a href="#logo"><img src="rentie.png" alt="rentie"></a>
    <a href="#home">Home</a>
    <a href="#verhuur">Autoverhuur</a>
    <a href="#over-ons">Contact</a>
    <a href="#contact">Inlog</a>
</nav>

<h2>Auto voor huur</h2>
<p>Klik op de auto om te huren</p>
<div class="carousel-container">
    <div class="carousel">
   
        <a href=""><img class="carousel-image" src="RS6.png" alt="Car 1"></a>
       <a href=""><img class="carousel-image" src="MercedesA.png" alt="Car 2"></a>
        <a href=""><img class="carousel-image" src="9111.png" alt="Car 3"></a>
       
    </div>
</div>

<footer>
    
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
    // Initialize the Slick Carousel
    $(document).ready(function(){
        $('.carousel').slick({
            // Customize Slick settings as needed
            dots: true,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            adaptiveHeight: true
        });
    });
</script>
</body>
</html>
