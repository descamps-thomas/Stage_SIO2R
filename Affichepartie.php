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
  <center><h2>AFFICHAGE DES PARTIES DE PÊCHE</h2></center>
</header>

<br><br><br>


<?php

function getColorStyle($typeuser) {
  switch ($typeuser) {
      case 1:
          return 'w3-text-green';
      case 2:
          return 'w3-text-red';
      default:
          return '';
  }
}

session_start();

if (!isset($_SESSION['typeuser']) || !isset($_SESSION['login']) || ($_SESSION['typeuser'] != "1" && $_SESSION['typeuser'] != "2")) {
    header('Location: index.php');
    exit();
}

$user=ini_get("mysqli.default_user");
$passwd=ini_get("mysqli.default_pw");
$server=ini_get("mysqli.default_host");
$dbname = "DomaineDPP";

try {
    $bdd = new PDO('mysql:host=' . $server . ';dbname=' . $dbname . ';charset=utf8', $user, $passwd);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

if ($_SESSION['typeuser'] == "2") {
    $requete1 = $bdd->prepare("SELECT Partiepeche.*, nomtypep AS Typepeche, nometang AS Etang 
        FROM Partiepeche
        JOIN Typepeche ON Partiepeche.typepecheid = Typepeche.id 
        JOIN Etang ON Partiepeche.etangid = Etang.id
        WHERE Partiepeche.etat = 1 ");
    
    $requete1->execute();
    $resultatt = $requete1->fetchAll(PDO::FETCH_ASSOC);
?>

<body>
    <center>
        <table class="w3-table-all w3-centered">
            <tr>
                <th>Nom de la partie</th>
                <th>Numéro de l'étang</th>
                <th>Type de pêche</th>
                <th>Nombre de places</th>
                <th>Date de la partie</th>
                <th></th>
            </tr>

            <?php foreach ($resultatt as $donne) {?>
                <tr>
                    <td><?php echo $donne['nom']; ?></td>
                    <td><?php echo $donne['Etang']; ?></td>
                    <td><?php echo $donne['Typepeche']; ?></td>
                    <td><?php echo $donne['nombremax']; ?></td>
                    <td><?php echo $donne['date']; ?></td>
                    <td>
                    <a href="Reserve.php?id=<?php echo $donne['id']; ?>">
                       Je réserve mes place
                    </a>
                    </td>
                </tr>
            <?php }?>
        </table>
    </center>

<?php } else if ($_SESSION['typeuser'] == "1") {
    $requete2 = $bdd->prepare("SELECT Partiepeche.*, nomtypep AS Typepeche, nometang AS Etang 
        FROM Partiepeche
        JOIN Typepeche ON Partiepeche.typepecheid = Typepeche.id 
        JOIN Etang ON Partiepeche.etangid = Etang.id ");
    $requete2->execute();
    $resultat = $requete2->fetchAll(PDO::FETCH_ASSOC);
?>

<body>
    <center>
        <table class="w3-table-all w3-centered">
            <tr>
                <th>Nom de la partie</th>
                <th></th>
                <th>Numéro de l'étang</th>
                <th>Type de pêche</th>
                <th>Nombre de places</th>
                <th>Date de la partie</th>
                <th></th>
            </tr>

            <?php foreach ($resultat as $donne) {
              ?>
                <tr>    
                    <td><?php echo $donne['nom']; ?></td>
                   
                    <td>
                        <form action="Admin/Etat.php" method="post"> 
                        <input type="hidden" name="id" value="<?php echo $donne['id']; ?>">
                        <input type="hidden" name="etat" value="<?php echo $donne['etat']; ?>">
                            <button type="submit" class="<?php echo getColorStyle($donne['etat']); ?>">
                            <i class="fa-solid fa-key"></i>
                            </button> 
                        </form>
                        </td>
               
                    <td><?php echo $donne['Etang']; ?></td>
                    <td><?php echo $donne['Typepeche']; ?></td>
                    <td><?php echo $donne['nombremax']; ?></td>
                    <td><?php echo $donne['date']; ?></td>
                    
                    <td>
                    <form action="Admin/AfficheReserv.php" method="get">
                    <input type="hidden" name="id" value="<?php echo $donne['id']; ?>">
                    <button type="submit">
                    <i class="fa-solid fa-eye"></i>
                    </button>
                    </form>
                    </td>

                    <td>
                    <form action="Admin/Modifpartie.php" method="get">
                    <input type="hidden" name="id" value="<?php echo $donne['id']; ?>">
                    <button type="submit">
                    <i class="fa fa-pen-to-square"></i>
                    </button>
                    </form>
                    </td>

                </tr>
            <?php }?>
        </table>
    </center>
<?php } ?>
    </table>
  </center>


<br><br><br>

<!-- Hide this text on small devices -->
<div class="w3-col m6 w3-hide-small w3-padding-large"></div>
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
  window.onscroll = function() {
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