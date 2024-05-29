<?php
session_start();
// Si l'agent n'est pas connecté
if (!isset($_SESSION["LOGIN"])) {
    header("Location: ../../Login");
    exit();
}

// Bouton déconnexion
if (isset($_POST['logout'])) {
    session_destroy();
    header('location: ../../Login');
}
?>

<!DOCTYPE html>
<html lang="fr_FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graphique de Température</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        #graphique {
            height: 300px; /* Hauteur ajustée pour le graphique */
            width: 70%; /* Largeur ajustée pour le graphique */
            margin: 0 auto; /* Centre le graphique horizontalement */
        }

        #retour-button {
            position: fixed;
            top: 20px; /* Ajusté pour déplacer le bouton un peu plus bas */
            right: 20px;
            background-color: transparent;
            border: none;
            cursor: pointer;
            color: #000191; /* Couleur de texte modifiée */
            font-size: 20px;
            z-index: 1000; /* Assure que le bouton est au-dessus du reste du contenu */
        }
    </style>
</head>
<body>
    <header>
        <?php include '../Templates/Header.php'; ?>
    </header>
    <main>
        <button id="retour-button" onclick="goBack()">✖</button>
        <canvas id="graphique"></canvas>
        
        <script>
            var ctx = document.getElementById('graphique').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Température',
                        data: [],
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 3,
                        lineTension: 0.5,
                    }]
                },
                
            });

            // Code PHP pour récupérer les données de température et les mettre à jour dans le graphique
            <?php
                require('AccessDB.php');

                try {
                    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $sql_temperature = "SELECT DATE_FORMAT(TIME, '%H:%i') AS TIME, MESURE FROM `CAPTEUR` WHERE ID_TYPE_CAPTEUR = 'T' AND DATE(TIME) = CURDATE() ORDER BY ID_CAPTEUR";
                    $stmt_temperature = $bdd->query($sql_temperature);
                    $temperature_data = array('TIME' => array(), 'MESURE' => array());

                    function fetch_data($stmt, &$data) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $data['TIME'][] = $row['TIME'];
                            $data['MESURE'][] = $row['MESURE'];
                        }
                    }

                    fetch_data($stmt_temperature, $temperature_data);

                    echo "chart.data.labels = " . json_encode($temperature_data['TIME']) . ";";
                    echo "chart.data.datasets[0].data = " . json_encode($temperature_data['MESURE']) . ";";
                    echo "chart.update();";

                } catch (PDOException $e) {
                    echo "Erreur de connexion : " . $e->getMessage();
                }
            ?>

            function goBack() {
                window.history.back();
            }
        </script>
    </main>
    <footer>
        <?php include '../Templates/Footer.html'; ?>
    </footer>
</body>
</html>
