<?php
session_start();
    // Si l'agent n'est pas connecté
    if(!isset($_SESSION["LOGIN"])){
        header("Location: Login");
    exit(); 
    }

    // Bouton déconnexion
    if(isset($_POST['logout'])){
        session_destroy();
        header('location: Login');
    }
?>

<!DOCTYPE html>
<html lang="fr_FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
</head>
<body>
    <?php include 'src/Templates/Header.html'; ?>
    <main>
        <section>
            <h1>Présentation du projet</h1>
            <p>Bienvenue sur le projet DRAC AKCP.</p>
            <p>En colaboration avec la Direction Régionale des Affaires Culturelles, ce projet a vu le jour suite à un incident au sein des datacenter du batiment.</p>

            <h2>Explication</h2>
            <p>En effet les serveurs de la DRAC ce sont mis en sécurité ce qui a causé l'arrêt de nombreux services.</p>

            <h3>Résolution</h3>
            <p>Une installation de capteurs de témpérature et d'humidité a été mis en place.</p>
        </section>
    </main>
    </body>
</html>