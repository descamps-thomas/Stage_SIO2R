<?php
session_start();

if (!isset($_SESSION['typeuser']) || !isset($_SESSION['login']) || ($_SESSION['typeuser'] != "1" )) {
    header('Location: index.php');
    exit();
} else {
    if(isset($_GET['id'])){
        $id = $_GET['id'];
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


        $requete_suppression1 = "DELETE FROM reservation WHERE userid = :id";
        $stmt = $bdd->prepare($requete_suppression1);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();



        $requete_suppression = "DELETE FROM User WHERE id = :id";
        $stmt = $bdd->prepare($requete_suppression);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        header('Location: Affiche.php');
        exit();
    } else {
        header('Location: ../index.php');
        exit();
    }
}
?>
