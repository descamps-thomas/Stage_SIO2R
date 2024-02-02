
<?php session_destroy(); ?>
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
  min-height: 100%;
}

/* Second image (Portfolio) */
.bgimg-2 {
  background-image: url('Images/domaine1.jpg');
  min-height: 350px;
}

/* Third image (Contact) */
.bgimg-3 {
  background-image: url('Images/domaine1.jpg');
  min-height: 350px;
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
    <a href="Inscriptionform.php" class="w3-bar-item w3-button" onclick="toggleFunction()">Inscription</a>
    <a href="Connexionform.php" class="w3-bar-item w3-button" onclick="toggleFunction()">Connection</a>
    <a href="index.php#contact" class="w3-bar-item w3-button" onclick="toggleFunction()">CONTACT</a>
  </div>
</div>

<!-- First Parallax Image with Logo Text -->
<div class="bgimg-1 w3-display-container w3-opacity-min" id="home">
  <div class="w3-display-middle" style="white-space:nowrap;">
    <span class="w3-center w3-padding-large w3-black w3-xlarge w3-wide w3-animate-opacity">Domaine <span class="w3-hide-small">du Pont</span> Prieur</span>
  </div>
</div>

<!-- Container (About Section) -->
<div class="w3-content w3-container w3-padding-64" id="about">
  <h3 class="w3-center">A Propos</h3>
  <p class="w3-center"><em>Domaine comportant 9 étangs de pêche à la truite avec bar et friterie le midi.</em></p>
  <center><p>Horaire<br>
        Ouvert tous les jours sauf le jeudi.<br>
              La demi-journée 18e <br>
                de 7h30 à 13h00<br>
                      OU <br>
                de 13h00 à 19h00<br>

              La Journée 32e<br>
              de 7h30 à 19h00</p><br></center>
             

  <div class="w3-row">
    <div class="w3-col m6 w3-center w3-padding-large">
    
      <img src="Images/peche1.jpg" class="w3-round w3-image w3-opacity w3-hover-opacity-off" alt="Photo of Me" width="500" height="333">
    </div>
    <div class="w3-col m6 w3-center w3-padding-large">
    
    <img src="Images/peche3.jpg" class="w3-round w3-image w3-opacity w3-hover-opacity-off" alt="Photo of Me" width="500" height="333">
  </div>
    <!-- Hide this text on small devices -->
    <div class="w3-col m6 w3-hide-small w3-padding-large">
      <p></p>
    </div>
  </div>
  </div>
</div>

<div class="w3-row w3-center w3-dark-grey w3-padding-small">
  <div class="w3-third w3-section">
    <span class="w3-xlarge">9</span><br>
    Etangs
  </div>
  <div class="w3-third w3-section">
    <span class="w3-xlarge">90%</span><br>
    De satisfaction
  </div>
  <div class="w3-third w3-section">
    <span class="w3-xlarge">75%</span><br>
    De beau poisson
  </div>
</div>


<!-- Container (Portfolio Section) -->
<div class="w3-content w3-container w3-padding-64" id="portfolio">
  <h3 class="w3-center">Les étangs</h3>
  <p class="w3-center"><em>Voici les étangs en location!<br>Cliquez pour voir plus </em></p><br>

  <!-- Responsive Grid. Four columns on tablets, laptops and desktops. Will stack on mobile devices/small screens (100% width) -->
  <div class="w3-row-padding w3-center">
    <div class="w3-col m3">
      <img src="Etangs/etangn2.jpg" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="Etangs n°1">
    </div>

    <div class="w3-col m3">
      <img src="Etangs/etangn3.jpg" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="Etangs n°2">
    </div>

    <div class="w3-col m3">
      <img src="Etangs/etangn6.jpg" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="Etangs n°3">
    </div>
    <div class="w3-col m3">
      <img src="Etangs/etangn4.jpg" style="width:100%" onclick="onClick(this)" class="w3-hover-opacity" alt="Etangs n°4">
    </div>
  </div>
  <br><br><br>
</div>

<!-- Modal for full size images on click-->
<div id="modal01" class="w3-modal w3-black" onclick="this.style.display='none'">
  <span class="w3-button w3-large w3-black w3-display-topright" title="Close Modal Image"><i class="fa fa-remove"></i></span>
  <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
    <img id="img01" class="w3-image">
    <p id="caption" class="w3-opacity w3-large"></p>
  </div>
</div>

<!-- Third Parallax Image with Portfolio Text -->
<div class="bgimg-3 w3-display-container w3-opacity-min">
  <div class="w3-display-middle">
     <span class="w3-xxlarge w3-text-white w3-wide">CONTACT</span>
  </div>
</div>

<!-- Container (Contact Section) -->
<div class="w3-content w3-container w3-padding-64" id="contact">
  <p class="w3-center"><em>Une question ?</em></p>
  <p class="w3-center"><i class="fa fa-envelope fa-fw w3-hover-text-black w3-xlarge w3-margin-right"></i>Email: pechepasdecalais@gmail.com</p>
</div>


<!-- Footer -->
<footer class="w3-center w3-black w3-padding-64 w3-opacity w3-hover-opacity-off">
  <a href="#home" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>Retour au début</a>
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

