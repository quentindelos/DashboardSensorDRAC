function getDataAndDisplay() {
    $.ajax({
        url: '/DashboardSensorDRAC/src/Scripts/GetDataSensor.php',
        type: 'GET',
        success: function(data) {
            var values = data.split(',');
            var temperature = parseFloat(values[0]);
            var humidity = parseFloat(values[1]);
            var co2 = parseFloat(values[2]);

            var alertIconHtml = '<img src="https://get-picto.com/wp-content/uploads/2023/09/attention-picto-png.webp" class="alert-icon" alt="Attention">';

            if (temperature > 32) {
                $('#temperature').html('Température actuelle : ' + temperature + ' °C ' + alertIconHtml).addClass('alert');
            } else {
                $('#temperature').html('Température actuelle : ' + temperature + ' °C').removeClass('alert').css('color', 'black');
            }
            if (humidity > 80) {
                $('#humidity').html("Taux d'humidité actuel : " + humidity + ' % ' + alertIconHtml).addClass('alert');
            } else {
                $('#humidity').html("Taux d'humidité actuel : " + humidity + ' %').removeClass('alert').css('color', 'black');
            }
            if (co2 > 1200) {
                $('#CO2').html('CO2 actuel : ' + co2 + ' ppm ' + alertIconHtml).addClass('alert');
            } else {
                $('#CO2').html('CO2 actuel : ' + co2 + ' ppm').removeClass('alert').css('color', 'black');
            }

            google.charts.load('current', {'packages':['gauge']});
            google.charts.setOnLoadCallback(function() {
                drawChart(temperature, humidity, co2);
            });
        },
        error: function(xhr, status, error) {
            console.error('Erreur lors de la récupération des données: ' + error);
        }
    });
}

function drawChart(temperature, humidity, co2) {
    var tempData = google.visualization.arrayToDataTable([
        ['Label', 'Value'],
        ['°C', temperature]
    ]);
    var optionsTemp = {
        width: 600,
        height: 200,
        greenFrom: 15,
        greenTo:30,
        yellowFrom: 30,
        yellowTo: 32,
        redFrom: 32,
        redTo: 35,
        minorTicks: 10,
        min: 15,
        max: 35
    };

    var humData = google.visualization.arrayToDataTable([
        ['Label', 'Value'],
        ['%', humidity]
    ]);
    var optionsHum = {
        width: 600,
        height: 200,
        greenFrom: 0,
        greenTo:70,
        yellowFrom: 70,
        yellowTo: 80,
        redFrom: 80,
        redTo: 100,
        minorTicks: 10,
        min: 0,
        max: 100
    };

    var co2Data = google.visualization.arrayToDataTable([
        ['Label', 'Value'],
        ['PPM', co2]
    ]);
    var optionsCO2 = {
        width: 600,
        height: 200,
        greenFrom: 400,
        greenTo:800,
        yellowFrom: 800,
        yellowTo: 1200,
        redFrom: 1200,
        redTo: 2000,
        minorTicks: 10,
        min: 400,
        max: 2000
    };

    var tempChart = new google.visualization.Gauge(document.getElementById('temp_div'));
    var humChart = new google.visualization.Gauge(document.getElementById('hum_div'));
    var co2Chart = new google.visualization.Gauge(document.getElementById('co2_div'));

    tempChart.draw(tempData, optionsTemp);
    humChart.draw(humData, optionsHum);
    co2Chart.draw(co2Data, optionsCO2);
}

$(document).ready(function() {
    // Appeler la fonction une première fois au chargement
    getDataAndDisplay();

    // Planifier l'exécution de la fonction toutes les deux minutes (120000 ms)
    setInterval(function() {
        getDataAndDisplay();
    }, 30000); // 30000 ms = 30 secondes
});
