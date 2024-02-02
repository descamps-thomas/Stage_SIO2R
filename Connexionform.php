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
body,html {
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
    <?php
    session_start();

    $serveur = "localhost";
    $utilisateur = "eleve";
    $motDePasse = "btsinfo";
    $baseDeDonnees = "DomaineDPP";

    try {
        $connexion = new PDO('mysql:host='.$serveur.';dbname='.$baseDeDonnees.';charset=utf8', $utilisateur, $motDePasse);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Échec de la connexion : " . $e->getMessage());
    }

    if (isset($_SESSION['utilisateur_connecte'])) {
        echo "Bienvenue " . htmlspecialchars($_SESSION['nom_utilisateur']); 
        echo '<br><a href="deconnexion.php">Se déconnecter</a>';
    } else {
        ?>
        <html>
        <center>
            <h2>CONNEXION</h2>
            </header>
        </center>

        <center>
            <h1>Formulaire de Connexion</h1>
            <p class="w3-opacity">Connexion au compte</p>
            <form method="post" action="">
                <table>
                    <tbody>
                        <tr>
                            <td><label>Login</label></td>
                            <td><input type="text" required="" name="login" maxlength="32"></td>
                        </tr>
                        <tr>
                            <td><label>Mot de passe</label></td>
                            <td><input type="password" required="" name="mdp" minlength="6" maxlength="32"></td>
                        </tr>
                    </tbody>
                </table>
                <br><input type="submit" name="submit" value="Envoyer">
            </form>

            <?php
            if (isset($_POST['submit'])) {
                $nom_utilisateur = $_POST['login'];
                $mot_de_passe = $_POST['mdp'];

                $requeteSQL = "SELECT * FROM User WHERE login = :login";
                $stmt = $connexion->prepare($requeteSQL);
                $stmt->bindParam(':login', $nom_utilisateur, PDO::PARAM_STR); 
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $ligne = $stmt->fetch(PDO::FETCH_ASSOC);

                    $motDePasseStocke = $ligne['mdp'];
                    $motDePasseAVerifierMD5 = md5($mot_de_passe);

                    if ($motDePasseAVerifierMD5 === $motDePasseStocke) {
                        $_SESSION['login'] = $nom_utilisateur;
                        $_SESSION['typeuser'] = $ligne['typeuser'];
                        header('Location: Menu.php');
                        exit(); 
                    } else {
                        echo "Le mot de passe est incorrect.";
                    }
                } else {
                    echo "L'utilisateur n'existe pas.";
                }
            }
            ?>
            <br><br><br>
        </html>

        <?php
        $connexion = null;
    }
    ?>
    </center>
    <!-- Hide this text on small devices -->
    <div class="w3-col m6 w3-hide-small w3-padding-large">
    </div>
    </div>
    </div>


    <!-- Footer -->
    <footer class="w3-center w3-black w3-padding-64 w3-opacity w3-hover-opacity-off">
    <a href="Menu.php" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>Allez au menu</a>
        <button class="w3-button w3-padding w3-white w3-center" onclick="window.location.href='index.php' ">Retour à l'accueil</button>
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
        window.onscroll = function () {
            myFunction()
        };

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
