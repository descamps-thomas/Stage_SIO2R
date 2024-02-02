
<!DOCTYPE html>
<html>
<head>
<title>Domaine du Pont Prieur</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif;}
body, html {
  height: 100%;
  color: #777;
  line-height: 1.8;
}

/* Create a Parallax Effect */
.bgimg-1, .bgimg-2, .bgimg-3 {
  background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

/* First image (Logo. Full height) */
.bgimg-1 {
  background-image: url('Images/domaine1.jpg');
  min-height: 32%;
}

.w3-wide {letter-spacing: 10px;}
.w3-hover-opacity {cursor: pointer;}

/* Turn off parallax scrolling for tablets and phones */
@media only screen and (max-device-width: 1024px) {
  .bgimg-1, .bgimg-2, .bgimg-3 {
    background-attachment: scroll;
  }
}
</style>
</head>
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar" id="myNavbar">
    <a class="w3-bar-item w3-button w3-hover-black w3-hide-medium w3-hide-large w3-right" href="javascript:void(0);" onclick="toggleFunction()" title="Toggle Navigation Menu">
      <i class="fa fa-bars"></i>
    </a>
    <a href="index.php#home" class="w3-bar-item w3-button">Acceuil</a>
    <a href="index.php#about" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-user"></i> A Propos</a>
    <a href="index.php#portfolio" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-tint"></i> Etangs en location</a>
    <a href="Inscriptionsform.php" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-registered"></i> Inscriptions</a>
    <a href="Connexionform.php" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-sign-in"></i> Connexion</a>
    <a href="index.php#contact" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-envelope"></i> CONTACT</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-red">
    </a>
  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium">
    <a href="index.php#about" class="w3-bar-item w3-button" onclick="toggleFunction()">A Propos</a>
    <a href="index.php#portfolio" class="w3-bar-item w3-button" onclick="toggleFunction()">Etangs en location</a>
    <a href="Inscription.php" class="w3-bar-item w3-button" onclick="toggleFunction()">Inscription</a>
    <a href="Connexion.php" class="w3-bar-item w3-button" onclick="toggleFunction()">Connection</a>
    <a href="index.php#contact" class="w3-bar-item w3-button" onclick="toggleFunction()">CONTACT</a>
  </div>
</div>
 
<div class="bgimg-1 w3-display-container w3-opacity-min" id="home">
  <div class="w3-display-middle" style="white-space:nowrap;">
  </div>
</div>
<header class="w3-center w3-black w3-padding-32 w3-opacity">
</header>  
<center>
<?php
session_start();
session_unset();
session_destroy();
header("Refresh: 1; url=./");
echo "Vous avez été correctement déconnecté du site.<br><br><i>Redirection en cours, vers la page d'accueil...</i>";
exit;
?>
