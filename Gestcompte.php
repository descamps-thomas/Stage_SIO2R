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
    <a href="Menu.php" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-sign-in"></i> Menu</a>
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
<center><h2>MODIFICATION DU COMPTE</h2></center>
    </header>

    <center>    
        <h1>Formulaire de MODIFICATION</h1>
        <p class="w3-opacity"></p>
        
<?php
session_start();

if (!isset($_SESSION['typeuser']) || !isset($_SESSION['login']) || ($_SESSION['typeuser'] != "1" && ($_SESSION['typeuser'] != "2" ))) {
  header('Location: index.php');
  exit();
}

$server = "localhost";
$dbname = "DomaineDPP";
$user = "eleve";
$passwd = "btsinfo";

try {
    $bdd = new PDO('mysql:host=' . $server . ';dbname=' . $dbname . ';charset=utf8', $user, $passwd);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $requeteSQL = "SELECT * FROM User WHERE login = :login";
    $stmt = $bdd->prepare($requeteSQL);

    $nom_utilisateur = $_SESSION['login'];

    $stmt->bindParam(':login', $nom_utilisateur, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $ligne = $stmt->fetch(PDO::FETCH_ASSOC);
        $nomStocke = $ligne['nom'];
        $prenomStocke = $ligne['prenom'];
        $emailStocke = $ligne['mail'];
        $mdpStocke = $ligne['mdp'];

        if (isset($_POST['submit'])) {
            $MDP = trim($_POST['mdp']);
            $MDP_CONFIRM = trim($_POST['confirm_mdp']);

            if ($MDP !== $MDP_CONFIRM) {
                echo "<html><center><h3>Les mots de passe ne correspondent pas.</h3></center></html>";
            } else {
                $MDP_HASHED = md5($MDP);
                $requete = $bdd->prepare("UPDATE User SET mdp = :nouveaumdp WHERE login = :login");
                $requete->bindParam(':nouveaumdp', $MDP_HASHED);
                $requete->bindParam(':login', $nom_utilisateur);

                if ($requete->execute()) {
                    echo "<html><center><h3>Mise à jour réussie!</h3></center></html>";
                    
                } else {
                    echo "<html><center><h3>Échec de la mise à jour du mot de passe.</h3></center></html>";
                }
            }
        }

        if (!isset($_POST['submit']) || (isset($_POST['submit']) && !$requete->execute())) {
?>
        <html>
        <center>
            <form action="Gestcompte.php" method="POST">
            <table>
                <tbody><tr><td><label>Nom</label></td><td><input type="text" name="nom" value="<?php echo htmlspecialchars($nomStocke); ?>" readonly></td></tr>
                <tr><td><label>Prénom</label></td><td><input type="text" name="prenom" value="<?php echo htmlspecialchars($prenomStocke); ?>" readonly></td></tr>
                <tr><td><label>Email</label></td><td><input type="email" name="email" value="<?php echo htmlspecialchars($emailStocke); ?>" readonly></td></tr>
                <tr><td><label>Nouveau Mot de passe</label></td><td><input type="password" required="" name="mdp" minlength="6" maxlength="32"></td></tr>
                <tr><td><label>Confirmer mot de passe</label></td><td><input type="password" required="" name="confirm_mdp" minlength="6" maxlength="32"></td></tr>
            </tbody></table>
            <br><input type="submit" name="submit" value="Envoyer">
        </form>
        </center>
        </html>
<?php
        }
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

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


