<?php

session_start();
if(!isset($_SESSION["login"]) && !isset($_SESSION["typeuser"])){
    if ($_SESSION["role"]!=1) {
    header('Location: ..');
    exit;
    }
}
        $lesLogs="";
        if(isset($_POST["login"])){
            $login = $_POST["login"];
            $lesLignes = file('DomaineDPPog.txt');
            foreach ($lesLignes as $numLigne => $uneLigne) {
                if(strpos($uneLigne, $login)){
                    $lesLogs = $uneLigne . $lesLogs;
                }
            }
            echo '<pre>'.$lesLogs.'</pre>';
            if(empty($lesLogs)){
                echo '<center><label class="w3-centered w3-text-deep-orange">Aucun log pour l\'utilisateur '.$loginU.' .</label></center>';
            }
        } elseif(isset($_POST["allLog"])){
            $lesLignes = file('pedagogeekLog.txt');
            foreach ($lesLignes as $numLigne => $uneLigne) {
                $lesLogs = $uneLigne . $lesLogs;
            }
            echo '<pre>'.$lesLogs.'</pre>';
            if(empty($lesLogs)){
                echo '<center><label class="w3-centered w3-text-deep-orange">Aucun log'.$login.' .</label></center>';
            }
        } elseif(isset($_POST["allFail"])){
            $lesLignes = file('pedagogeekLog.txt');
            foreach ($lesLignes as $numLigne => $uneLigne) {
                if(strpos($uneLigne, "fail")){
                    $lesLogs = $uneLigne . $lesLogs;
                }
            }
            echo '<pre>'.$lesLogs.'</pre>';
            if(empty($lesLogs)){
                echo '<center><label class="w3-centered w3-text-deep-orange">Aucun log fail.</label></center>';
            }
        }
        


        ?>
