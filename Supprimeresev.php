<?php
session_start();

if (!isset($_SESSION['typeuser']) || !isset($_SESSION['login']) || ($_SESSION['typeuser'] != "1")) {
    header('Location: index.php');
    exit();
} else {
    if (isset($_GET['id']) && isset($_GET['id_partie'])) {
        $id_partie = $_GET['id'];
        $id = $_GET['id_partie'];
        $server = "localhost";
        $dbname = "DomaineDPP";
        $user = "eleve";
        $passwd = "btsinfo";

        try {
            $bdd = new PDO('mysql:host=' . $server . ';dbname=' . $dbname . ';charset=utf8', $user, $passwd);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }

        $requete_suppression1 = "DELETE FROM reservation WHERE partiepecheid = :partiepecheid AND userid = :userid";
        $stmt = $bdd->prepare($requete_suppression1);
        $stmt->bindParam(':partiepecheid', $id_partie, PDO::PARAM_INT); 
        $stmt->bindParam(':userid', $id, PDO::PARAM_INT);              

        $stmt->execute();

        header('Location: AfficheReserv.php?id=' . $id_partie);
        exit();
    } else {
        echo "Paramètres manquants. Redirection vers index.php";
        exit();
    }
}
?>
