<?php
session_start();

// Vérification de la session utilisateur
if (!isset($_SESSION["LOGIN"])) {
    header("Location: Login");
    exit();
}

// Déconnexion de l'utilisateur
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: Login');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr_FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/DashboardSensorDRAC/src/Styles/img/logo-Marianne.ico" type="image/x-icon">
    <title>Projet DRAC SNIR 2024</title>
    <link rel="stylesheet" href="/DashboardSensorDRAC/src/Styles/home.css">
    <style>
        .background-blur {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('/DashboardSensorDRAC/src/Styles/img/drac-hdf.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        filter: blur(8px);
        z-index: -1;
        }
    </style>
</head>
<body>
    <header>
        <?php include 'src/Templates/Header.php'; ?>
    </header>
    <div class="background-blur"></div>
        <main>
            <div class="contain">
            <h1>Bienvenue sur le projet DRAC AKCP</h1>
            <p>En collaboration avec la Direction Régionale des Affaires Culturelles, ce projet vise à sécuriser et optimiser les infrastructures informatiques critiques suite à un incident majeur au sein des datacenters du bâtiment.</p>

            <h2>Explication</h2>
            <p>Les serveurs de la DRAC ont perdu la climatisation qui , entraînant l'interruption de nombreux services essentiels. Cet événement a souligné l'importance d'une surveillance continue de la température et de l'humidité dans les datacenters.</p>

            <h3>Résolution</h3>
            <p>Pour résoudre ces problèmes, une installation de capteurs de température et d'humidité a été mise en place pour assurer la stabilité et la sécurité des infrastructures. Ce projet vise à prévenir de futurs incidents et à maintenir une disponibilité élevée des services culturels critiques.</p>
            <a href="/DashboardSensorDRAC/src/Styles/files/Fiche_presentation-projet.pdf" type="application/pdf" download>Télécharger la fiche de présentation du projet.</a>
        </div>
    </main>
    <footer>
        <?php include 'src/Templates/Footer.html'; ?>
    </footer>
</body>
</html>