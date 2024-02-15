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
    body, h1, h2, h3, h4, h5, h6 { font-family: "Lato", sans-serif; }
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
      background-image: url('../Images/domaine1.jpg');
      min-height: 42px;
    }
    .w3-wide { letter-spacing: 10px; }
    .w3-hover-opacity { cursor: pointer; }
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
    <a href="../index.php#home" class="w3-bar-item w3-button">Accueil</a>
    <a href="../index.php#about" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-user"></i> A Propos</a>
    <a href="../index.php#portfolio" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-tint"></i> Etangs en location</a>
    <a href="../index.php#contact" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-envelope"></i> Contact</a>
    <a href="../Inscriptionsform.php" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-registered"></i> Inscriptions</a>
    <a href="../Connexionform.php" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-sign-in"></i> Connexion</a>
    <a href="../Menu.php" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-sign-in"></i> Menu</a>
    <a href="../deconnexion.php" class="w3-bar-item w3-button w3-hide-small w3-right"><i class="fa fa-sign-out"></i> Déconnexion</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-red"></a>
  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium">
    <a href="../index.php#about" class="w3-bar-item w3-button" onclick="toggleFunction()">A Propos</a>
    <a href="../index.php#portfolio" class="w3-bar-item w3-button" onclick="toggleFunction()">Etangs en location</a>
    <a href="../index.php#contact" class="w3-bar-item w3-button" onclick="toggleFunction()">Contact</a>
    <a href="../Inscription.php" class="w3-bar-item w3-button" onclick="toggleFunction()">Inscription</a>
    <a href="../Connexion.php" class="w3-bar-item w3-button" onclick="toggleFunction()">Connexion</a>
    <a href="../Menu.php" class="w3-bar-item w3-button" onclick="toggleFunction()">Menu</a>
    <a href="../deconnexion.php" class="w3-bar-item w3-button" onclick="toggleFunction()">Deconnexion</a>
  </div>
</div>
<div class="bgimg-1 w3-display-container w3-opacity-min" id="home">
  <div class="w3-display-middle" style="white-space:nowrap;">
</div>
</div>
</body>
<script src="https://kit.fontawesome.com/1efcc5ad4f.js" crossorigin="anonymous"></script>


<header class="w3-center w3-black w3-padding-32 w3-opacity">
<center><h2>CHANGEMENT DES IMAGES </h2></center>
</header>
<br><br><br>
<center>
<?php
session_start();

if (!isset($_SESSION['typeuser']) || !isset($_SESSION['login']) || ($_SESSION['typeuser'] != "1")) {
    header('Location: ../index.php');
    exit();
} else {
    $server = "localhost";
    $dbname = "DomaineDPP";
    $user = "eleve";
    $passwd = "btsinfo";

    try {
        $bdd = new PDO('mysql:host=' . $server . ';dbname=' . $dbname . ';charset=utf8', $user, $passwd);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $cheminImages = realpath("/var/www/html/Images") . "/";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $nomImage = "peche1.jpg";  
            $cheminFinal = $cheminImages . $nomImage;

            if ($_FILES["image"]["error"] > 0) {
                echo "Erreur lors du téléchargement de l'image. Code d'erreur : " . $_FILES["image"]["error"];
                exit();
            }

            if (copy($_FILES["image"]["tmp_name"], $cheminFinal)) {
                unlink($_FILES["image"]["tmp_name"]);
                echo "L'image a été déplacée avec succès.";
            } else {
                echo "Erreur lors du déplacement de l'image.";
                exit();
            }

            $insertQuery = "INSERT INTO table_images (chemin_image) VALUES ('$cheminFinal')";
            $result = $bdd->query($insertQuery);

            if ($result) {
                echo "L'image a été insérée avec succès dans le dossier et dans la base de données.";
            } else {
                echo "Erreur lors de l'insertion de l'image dans la base de données : " . $bdd->errorInfo()[2];
            }
        }
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    } finally {
        $bdd = null;
    }
}
?>
</center>

<div class="w3-container">
  <!-- Hide this text on small devices -->
  <div class="w3-row">
    <div class="w3-col m6 w3-hide-small w3-padding-large">
    </div>
  </div>

  <!-- Hide this text on small devices -->
  <div class="w3-row">
    <div class="w3-col m6 w3-hide-small w3-padding-large">
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="w3-center w3-black w3-padding-64 w3-opacity w3-hover-opacity-off">
  <a href="../Menu.php" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>Allez au menu</a>
  <a href="../index.php#home" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>Retour à l'accueil</a>
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green">w3.css</a></p>
</footer>

<script>
// Modal Image Gallery
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
  var captionText = document.getElementById("caption");
  captionText.innerHTML = element.alt;
}

// Change style of navbar on scroll
window.onscroll = function() { myFunction() };
function myFunction() {
  var navbar = document.getElementById("myNavbar");
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    navbar.className = "w3-bar w3-card w3-animate-top w3-white";
  } else {
    navbar.className = navbar.className.replace(" w3-card w3-animate-top w3-white", "");
  }
}

// Used to toggle the menu on small screens when clicking on the menu button
function toggleFunction() {
  var x = document.getElementById("navDemo");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else {
    x.className = x.className.replace(" w3-show", "");
  }
}
</script>

</body>
</html>

