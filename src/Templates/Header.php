<!DOCTYPE html>
<html lang="fr_FR" data-bs-theme="auto">
  <head>
 
    <meta charset="utf-8">
    <link rel="stylesheet" href="Styles/Header.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../Styles/img/logo-Marianne.ico" type="image/x-icon">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/headers/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="https://getbootstrap.com/docs/5.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
      .nav-icon {
        width: 24px;
        height: 24px;
      }

      .navbar-custom {
        background-color: #000091; /* Couleur foncée */
        border-bottom: 2px solid #f8f9fa; /* Bordure blanche en bas */
        border-radius: 50px; /* Bords arrondis */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Ombre subtile */
        padding: 0.5rem 1rem; /* Espacement intérieur */
        max-width: 1200px; /* Limite la largeur maximale */
        margin: auto; /* Centre la navbar */
        margin-top: 20px; /* Marge en haut du header */
      }

      .navbar-custom .nav-link {
        color: #f8f9fa; /* Texte en blanc */
        font-weight: bold; /* Police en gras */
        transition: color 0.3s; /* Transition de couleur */
      }

      .navbar-custom .nav-link:hover {
        color: #007bff; /* Changement de couleur au survol */
      }

      .navbar-logo {
        fill: #f8f9fa; /* Couleur blanche pour le logo de la maison */
      }

      .navbar-person {
        fill: #f8f9fa; /* Couleur blanche pour le symbole de personne */
      }

      .dropdown-menu {
        border-radius: 10px; /* Arrondir les coins du menu déroulant */
      }
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-custom">
      <div class="container">
        <a href="/DashboardSensorDRAC/" class="navbar-brand d-flex align-items-center link-body-emphasis text-decoration-none">
          <svg class="bi nav-icon navbar-logo" fill="currentColor">
            <use href="#home"></use>
          </svg>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="/DashboardSensorDRAC/src/Includes/Dashboard" class="nav-link px-3">Dashboard</a>
            </li>
            <li class="nav-item">
              <a href="/DashboardSensorDRAC/src/Includes/Graph" class="nav-link px-3">History</a>
            </li>
            <?php
              if ($_SESSION['ID_TYPE_USER'] == 'A') {
                  echo "<li class='nav-item'><a href='/DashboardSensorDRAC/src/Includes/Users' class='nav-link px-3'>Users</a></li>";
              }
            ?>
             <li class="nav-item">
              <a href="http://192.168.112.15/app.html#/" target="_blank" class="nav-link px-3">AKCP</a>
            </li>
            <li class="nav-item">
              <a href="http://192.168.112.12/nagios/" target="_blank" class="nav-link px-3">Nagios</a>
            </li>
          </ul>
        </div>

        <div class="dropdown text-end">
          <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-circle navbar-person" viewBox="0 0 16 16">
              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
              <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
            </svg>
          </a>
          <ul class="dropdown-menu text-small">
            <li><a class="dropdown-item" href="/DashboardSensorDRAC/src/Includes/Profile">Settings</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><form method="POST"><button class="dropdown-item" type='submit' name='logout'>Déconnexion</button></form></li>
          </ul>
        </div>
      </div>
    </nav>

    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
      <symbol id="home" viewBox="0 0 16 16">
        <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5-5 5 5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
      </symbol>
    </svg>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
