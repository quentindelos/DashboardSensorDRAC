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

    // Connexion à la base de données
    require('AccessDB.php');
    try {
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }

    // Récupérer l'état de l'utilisateur actuel
    $LOGIN = $_SESSION["LOGIN"];
    $ID_TYPE_USER = $bdd->prepare('SELECT ID_TYPE_USER FROM USER WHERE LOGIN = ?');
    $ID_TYPE_USER->execute([$LOGIN]);
    $result = $ID_TYPE_USER->fetch();

    // Si l'utilisateur actuel a un état d'utilisateur égal à 1, rediriger vers la page d'accueil
    if ($result['ID_TYPE_USER'] != 'A') {
        header("Location: ../..");
    }

    //Génère un mot de passe
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $length = strlen($alphabet);
    $TempPassword = "";
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $length - 1);
        $TempPassword .= $alphabet[$n];
    }
    

    // Traitement du formulaire d'enregistrement
    if(isset($_POST['CreateUser'])){
        if(!empty($_POST['FIRSTNAME']) && !empty($_POST['LASTNAME']) && !empty($_POST['EMAIL']) && !empty($_POST['ID_TYPE_USER'])){
            $FIRSTNAME = htmlspecialchars($_POST['FIRSTNAME']);
            $LASTNAME = htmlspecialchars($_POST['LASTNAME']);
            $LOGIN = strtolower($_POST['FIRSTNAME'] . '.' . $_POST['LASTNAME']);
            $EMAIL = htmlspecialchars($_POST['EMAIL']);
            $ID_TYPE_USER = htmlspecialchars($_POST['ID_TYPE_USER']);
            $PASSWORD = $TempPassword;
            $hashed_password = password_hash($PASSWORD, PASSWORD_DEFAULT);
            

            // Vérifier si l'utilisateur existe déjà
            $checkname = $bdd->prepare("SELECT LOGIN FROM USER WHERE LOGIN=:login");
            $checkname->execute([':login' => $LOGIN]);
            $rowCount = $checkname->rowCount();
            if ($rowCount == 0) {
                // Insérer un nouvel utilisateur
                $InsertUser = $bdd->prepare('INSERT INTO USER (FIRSTNAME, LASTNAME, LOGIN, EMAIL, PASSWORD, ID_TYPE_USER) VALUES (?, ?, ?, ?, ?, ?)');
                $InsertUser->execute([$FIRSTNAME, $LASTNAME, $LOGIN, $EMAIL, $hashed_password, $ID_TYPE_USER]);
                
                //Envoi du mot de passe par mail
                require ('PHPMailer-Files/script.php');
                $subject = "Création de votre compte";
                $message = "Bonjour " . $FIRSTNAME . ",\r\nVotre compte a bien été créé.\r\nVous pouvez dès maintenant vous connectez à l'interface de surveillance des baies de brassage par ce lien : http://127.0.0.1/projet/ \r\n\r\n Votre mot de passe temporaire est : " . $TempPassword ."\r\n\r\nPensez à le changer votre mot de passe une fois que vous vous êtes connecté.\r\n\r\nBonne journée.";
                sendMail($_POST['EMAIL'], $subject, $message);

                // Vérifier si l'insertion a réussi
                if($InsertUser->rowCount() > 0){
                    echo "<script type='text/javascript'>alert('L'utilisateur a été créé avec succès.');</script>";
                } else {
                    echo "<script type='text/javascript'>alert('Une erreur s'est produite lors de la création de l'utilisateur.');</script>";
                }
            } else {
                echo "<script type='text/javascript'>alert('L'utilisateur existe déjà.');</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Veuillez remplir tous les champs.');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="fr_FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Styles/AddUsers.css">
    <title>Ajouter Utilisateur</title>
</head>
<body>
    <?php include '../Templates/Header.html'; ?>
    <?php include '../Templates/AddUsers.html'; ?>
</body>
</html>