<?php
session_start();

if (!isset($_SESSION['typeuser']) || !isset($_SESSION['login']) || ($_SESSION['typeuser'] != "1" )) {
    header('Location: index.php');
    exit();
} else {
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $user=ini_get("mysqli.default_user");
        $passwd=ini_get("mysqli.default_pw");
        $server=ini_get("mysqli.default_host");
        $dbname = "DomaineDPP";

        try {
            $bdd = new PDO('mysql:host=' . $server . ';dbname=' . $dbname . ';charset=utf8', $user, $passwd);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }

        $requete_suppression = "DELETE FROM Compte WHERE id = :id";
        $stmt = $bdd->prepare($requete_suppression);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        header('Location: Compta.php');
        exit();
    } else {
        header('Location: ../index.php');
        exit();
    }
}
?>
