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
  </div>
</div>
<div class="bgimg-1 w3-display-container w3-opacity-min" id="home">
  <div class="w3-display-middle" style="white-space:nowrap;">
</div>
</div>
</body>



<header class="w3-center w3-black w3-padding-32 w3-opacity center-content">
    <h2>AJOUT DE DONNEE</h2>
</header>
<div class="center-content">
    <center>
    <?php
session_start();


    if (!isset($_SESSION['typeuser']) || !isset($_SESSION['login']) || ($_SESSION['typeuser'] != "1" )) {
        header('Location: ../index.php');
        exit();
    } else {
      $user=ini_get("mysqli.default_user");
      $passwd=ini_get("mysqli.default_pw");
      $server=ini_get("mysqli.default_host");
      $dbname = "DomaineDPP";
      
        
        try {
            $bdd = new PDO('mysql:host=' . $server . ';dbname=' . $dbname . ';charset=utf8', $user, $passwd);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            $requete = $bdd->prepare("SELECT id, typeecriture FROM Typeecriture");
            $requete->execute();
            $typeecriture = $requete->fetchAll(PDO::FETCH_ASSOC);

            $id = $typeecriture['id'];
            $type = $typeecriture['typeecriture'];



        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }        
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $LIBELLE = (trim($_POST['libellé']));
            $PRIX = trim($_POST['Prix']);
            $TYPE = trim($_POST['type']);
        
            try {
                $requete = $bdd->prepare("INSERT INTO Compte (libelle, prix, type, date) VALUES(:libelle, :prix, :type, NOW())");
                $requete->bindParam(':libelle', $LIBELLE);
                $requete->bindParam(':prix', $PRIX);
                $requete->bindParam(':type', $TYPE);
                $requete->execute();
    
                header('Location: Compta.php');
                 exit();
        
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }
    }
    ?>
    
    <h1>Formulaire d'ajouts de donnée</h1>
    <form action="Entree.php" id="" method="POST">
        <table>
            <tbody>
                <tr><td><label>Libellé</label></td><td><input type="text" required="" name="libellé" maxlength="32"></td></tr>
                <tr><td><label>Prix</label></td><td><input type="number" step="0.01" required="" name="Prix" ></td></tr>
                <tr>
                    <td><label>Type d'écriture</label></td>
                    <td>
                        <select required="" class="w3-select" name="type">
                            <option value="" disabled selected>Type d'écriture</option>
                            <?php
                            foreach ($typeecriture as $type) {
                                echo '<option value="' . $type['id'] . '">' . $type['typeecriture'] . '</option>';
                            }
                            ?>
                        </select>
                    </td>
            </tbody>
        </table>
        <br><input type="submit" value="Envoyer">
    </form>
</div>    
</center>
<br><br><br>


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



