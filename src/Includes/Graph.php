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
    <link rel="shortcut icon" href="/DashboardSensorDRAC/src/Styles/img/logo-Marianne.ico" type="image/x-icon">
    <title>Graphiques en temps réel</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .charts-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 20px;
        }

        .chart-container {
            margin-top: 100px;
            flex: 1 1 calc(33.33% - 20px);
            max-width: 33.33%;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            cursor: pointer;
        }

        canvas {
            width: 100% !important;
            height: 300px !important;
        }
    </style>
    <script>
        function updateChart(chart, url) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var data = JSON.parse(xhr.responseText);
                        chart.data.labels = data.labels;
                        chart.data.datasets[0].data = data.data;
                        chart.update();
                    }
                }
            };
            xhr.open("GET", url, true);
            xhr.send();
        }

        setInterval(function () {
            updateChart(chartTemp, 'fetch_data.php?type=temperature');
            updateChart(chartHumid, 'fetch_data.php?type=humidity');
            updateChart(chartCO2, 'fetch_data.php?type=co2');
        }, 2000);
    </script>
</head>

<body>
    <header>
        <?php include '../Templates/Header.php'; ?>
    </header>
    <main>
        <div class="charts-container">
            <div class="chart-container" onclick="window.location.href='temperature_chart.php'">
                <canvas id="graphiqueTemp"></canvas>
            </div>
            <div class="chart-container" onclick="window.location.href='humidity_chart.php'">
                <canvas id="graphiqueHumid"></canvas>
            </div>
            <div class="chart-container" onclick="window.location.href='co2_chart.php'">
                <canvas id="graphiqueCO2"></canvas>
            </div>
        </div>

        <script>
            var ctxTemp = document.getElementById('graphiqueTemp').getContext('2d');
            var chartTemp = new Chart(ctxTemp, {
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

            var ctxHumid = document.getElementById('graphiqueHumid').getContext('2d');
            var chartHumid = new Chart(ctxHumid, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Humidité',
                        data: [],
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 3,
                        lineTension: 0.5,
                    }]
                },
               
            });

            var ctxCO2 = document.getElementById('graphiqueCO2').getContext('2d');
            var chartCO2 = new Chart(ctxCO2, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'CO2',
                        data: [],
                        backgroundColor: 'rgba(255, 206, 86, 0.2)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 3,
                        lineTension: 0.5,
                    }]
                },
                
            });
        </script>

        <?php
        require('AccessDB.php');

        try {
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            function fetch_sensor_data($bdd, $type)
            {
                $data = array('TIME' => array(), 'MESURE' => array());
                $sql = "SELECT DATE_FORMAT(TIME, '%H:%i') AS TIME, MESURE FROM `CAPTEUR` WHERE ID_TYPE_CAPTEUR = :type AND DATE(TIME) = CURDATE() ORDER BY ID_CAPTEUR";
                $stmt = $bdd->prepare($sql);
                $stmt->execute(array(':type' => $type));
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $data['TIME'][] = $row['TIME'];
                    $data['MESURE'][] = $row['MESURE'];
                }
                return $data;
            }

            $temperature_data = fetch_sensor_data($bdd, 'T');
            $humidity_data = fetch_sensor_data($bdd, 'H');
            $co2_data = fetch_sensor_data($bdd, 'C');

            echo "<script>";
            echo "var temperatureData = " . json_encode(array('labels' => $temperature_data['TIME'], 'data' => $temperature_data['MESURE'])) . ";";
            echo "chartTemp.data.labels = temperatureData.labels;";
            echo "chartTemp.data.datasets[0].data = temperatureData.data;";
            echo "chartTemp.update();";

            echo "var humidityData = " . json_encode(array('labels' => $humidity_data['TIME'], 'data' => $humidity_data['MESURE'])) . ";";
            echo "chartHumid.data.labels = humidityData.labels;";
            echo "chartHumid.data.datasets[0].data = humidityData.data;";
            echo "chartHumid.update();";

            echo "var co2Data = " . json_encode(array('labels' => $co2_data['TIME'], 'data' => $co2_data['MESURE'])) . ";";
            echo "chartCO2.data.labels = co2Data.labels;";
            echo "chartCO2.data.datasets[0].data = co2Data.data;";
            echo "chartCO2.update();";
            echo "</script>";
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
        ?>
    </main>
    <footer>
        <?php include '../Templates/Footer.html'; ?>
    </footer>
</body>

</html>
