<?php
session_start();
    // Si l'agent n'est pas connecté
    if(!isset($_SESSION["LOGIN"])){
        header("Location: ../../Login");
    exit(); 
    }

    // Bouton déconnexion
    if(isset($_POST['logout'])){
        session_destroy();
        header('location: ../../Login');
    }

    require('accessDB.php');
    // Récupérer la dernière valeur de température
    $RecupTemperature = $bdd->query("SELECT MESURE FROM CAPTEUR WHERE ID_TYPE_CAPTEUR = 'T' ORDER BY ID_CAPTEUR DESC LIMIT 1")->fetchColumn();
    // Récupérer la dernière valeur d'humidité
    $RecupHumidity = $bdd->query("SELECT MESURE FROM CAPTEUR WHERE ID_TYPE_CAPTEUR = 'H' ORDER BY ID_CAPTEUR DESC LIMIT 1")->fetchColumn();
    // Récupérer la dernière valeur de CO2
    $RecupCO2 = $bdd->query("SELECT MESURE FROM CAPTEUR WHERE ID_TYPE_CAPTEUR = 'C' ORDER BY ID_CAPTEUR DESC LIMIT 1")->fetchColumn();

    $values =  $RecupTemperature . ',' . $RecupHumidity . ',' . $RecupCO2 . ',';

    echo $values;
?>

<!DOCTYPE html>
<html lang="fr_FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../Scripts/sensors.js"></script>
    <title>Dashboard</title>
</head>
<body>
    <?php include '../Templates/Header.html'; ?>
    <main>
        <div class="sensors">
            <h2>Capteurs</h1>
            <p><u>Affiche toutes les valeurs des capteurs</u></p>
            <p id="temperature"></p>
            <p id="humidity"></p>
            <p id="CO2"></p>
        </div>
    </main>
    </body>
</html>