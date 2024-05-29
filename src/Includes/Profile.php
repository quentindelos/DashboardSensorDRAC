<?php
session_start();

// Paramètres de sécurité de la session
ini_set('session.cookie_httponly', 1);
ini_set('session.cookie_secure', 1);
ini_set('session.use_strict_mode', 1);
session_regenerate_id(true);

// Si l'agent n'est pas connecté
if (!isset($_SESSION["LOGIN"])) {
    header("Location: ../../Login");
    exit();
}

// Générer un token CSRF pour la protection des formulaires
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Bouton déconnexion
if(isset($_POST['logout'])){
    session_destroy();
    header('location: ../../Login');
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/DashboardSensorDRAC/src/Styles/img/logo-Marianne.ico" type="image/x-icon">
    <title>Profile</title>
    <style>
        /* Ajoutez des styles de base pour améliorer l'apparence */
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    font-size: 16px; /* Taille de police de base */
}

/* Augmenter la taille de la police pour le texte principal */
.profile-section {
    font-size: 18px; /* Taille de police plus grande pour la section de profil */
}


        main {
            padding: 2em;
        }
        a {
            color: #007BFF;
            text-decoration: none;
            font-weight: bold;
        }
       
        .profile-section {
            background-color: #fff;
            padding: 2em;
            margin: 2em 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .logout-form {
            margin-top: 1em;
        }
        button{
            display: inline-block;
            padding: 0.5em 1em;
            font-size: 1em;
            font-weight: bold;
            color: #fff;
            background-color: #dc3546;
            border: 1px;
            border-radius: 4px;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;}

         .button-link {
            display: inline-block;
            padding: 0.5em 1em;
            font-size: 1em;
            font-weight: bold;
            color: #fff;
            background-color: #000191;
            border: 1px;
            border-radius: 4px;
            text-align: center;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        button:hover{
            background-color: #bf424e;
        }
        .button-link:hover {
            background-color: #0056b3;
        }
        
    </style>
</head>
<body>
    <header>
        <?php include '../Templates/Header.php'; ?>
    </header>
    <main>
        <section class="profile-section">
            <h1>Paramètres de profil</h1>
            <?php
                $firstname = htmlspecialchars($_SESSION["FIRSTNAME"], ENT_QUOTES, 'UTF-8');
                $lastname = htmlspecialchars($_SESSION["LASTNAME"], ENT_QUOTES, 'UTF-8');
                echo 'Bonjour ' . $firstname . ' ' . $lastname;
            ?>
            <br><br>
            <a href="Change_Password" class="button-link">Changer mon mot de passe</a>
            <br><br>
            <a href="Recovery_Password" class="button-link">Mot de passe oublié</a>
            <br><br>

            <form method="post" class="logout-form">
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
                <button type="submit" name="logout">Déconnexion </button>
            </form>
        </section>
    </main>
    <footer>
        <?php include '../Templates/Footer.html'; ?>
    </footer>
</body>
</html>
