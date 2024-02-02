<?php session_start();?>
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

/* Ajoutez cette classe pour centrer le contenu */
.center-content {
    text-align: center;
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
<header class="w3-center w3-black w3-padding-32 w3-opacity center-content">
    <h2>CREATION DE L'EVENEMENT</h2>
</header>
<div class="center-content">
    <center>
    <?php
    if (!isset($_SESSION['typeuser']) || !isset($_SESSION['login']) || ($_SESSION['typeuser'] != "1" )) {
        header('Location: index.php');
        exit();
    } else {
    
        $server = "localhost";
        $dbname = "DomaineDPP";
        $user = "eleve";
        $passwd = "btsinfo";
        
        try {
            $bdd = new PDO('mysql:host=' . $server . ';dbname=' . $dbname . ';charset=utf8', $user, $passwd);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            $requete = $bdd->prepare("SELECT id, nomtypep FROM Typepeche");
            $requete->execute();
        
            $typesDePeche = $requete->fetchAll(PDO::FETCH_ASSOC);
        
            $requete = $bdd->prepare("SELECT id, nometang FROM Etang");
            $requete->execute();
        
            $typesEtang = $requete->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }        
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $NOM = strtolower(trim($_POST['nom']));
            $PM = trim($_POST['personnemax']);
            $ETANG = trim($_POST['etang']);
            $TYPE = strtolower(trim($_POST['typeP']));
            $DATE = strtolower(trim($_POST['date']));
        
            try {
                $requete = $bdd->prepare("INSERT INTO Partiepeche (nom, nombremax, date, etangid, typepecheid) VALUES(:nom, :nombremax, :date, :etangid, :typepecheid)");
                $requete->bindParam(':nom', $NOM);
                $requete->bindParam(':nombremax', $PM);
                $requete->bindParam(':date', $DATE);
                $requete->bindParam(':etangid', $ETANG);
                $requete->bindParam(':typepecheid', $TYPE);
                $requete->execute();
        
                echo "Événement créé avec succès.";
        
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }
    }
    ?>
    
    <h1>Formulaire de création d'événement</h1>
    <form action="Creareserv.php" id="" method="POST">
        <table>
            <tbody>
                <tr><td><label>Nom de l'événement</label></td><td><input type="text" required="" name="nom" maxlength="32"></td></tr>
                <tr><td><label>Personne max</label></td><td><input type="number" required="" name="personnemax" maxlength="32"></td></tr>
                <tr>
                    <td><label>Nom de l'étang</label></td>
                    <td>
                        <select required="" class="w3-select" name="etang">
                            <option value="" disabled selected>Nom de l'étang</option>
                            <?php
                            foreach ($typesEtang as $etang) {
                                echo '<option value="' . $etang['id'] . '">' . $etang['nometang'] . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>

                    </td>
                </tr>
                
                <tr>
                    <td><label>Type de pêche</label></td>
                    <td>
                        <select required="" class="w3-select" name="typeP"> 
                            <option value="" disabled selected>Type de pêche</option> 
                            <?php
                            foreach ($typesDePeche as $type) {
                                echo '<option value="' . $type['id'] . '">' . $type['nomtypep'] . '</option>';
                            }
                            ?>
                        </select>

                <tr><td><label>Date de l'événement</label></td><td><input type="date" required="" name="date" maxlength="32"></td></tr>
            </tbody>
        </table>
        <br><input type="submit" value="Envoyer">
    </form>
</div>    
</center>
<br><br><br>

<!-- Hide this text on small devices -->
<div class="w3-col m6 w3-hide-small w3-padding-large">
</div>
</div>
</div>


<!-- Footer -->
<footer class="w3-center w3-black w3-padding-64 w3-opacity w3-hover-opacity-off">
<a href="Menu.php" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>Allez au menu</a>
  <a href="index.php#home" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>Retour à l'accueil</a>
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
window.onscroll = function() {myFunction()};
function myFunction() {
    var navbar = document.getElementById("myNavbar");
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        navbar.className = "w3-bar" + " w3-card" + " w3-animate-top" + " w3-white";
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

