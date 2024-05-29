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
    header('Location: ../../Login');
    exit();
}

// Si l'utilisateur actuel n'est pas Administrateur, rediriger vers la page d'accueil
if ($_SESSION['ID_TYPE_USER'] != 'A') {
    header("Location: ../..");
    exit();
}

// Connexion à la base de données
require('AccessDB.php');

try {
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Récupérer les utilisateurs
$recupUser = $bdd->prepare("SELECT ID, FIRSTNAME, LASTNAME, EMAIL, LIBELLE_TYPE_USER, USER.ID_TYPE_USER FROM USER INNER JOIN TYPE_USER ON USER.ID_TYPE_USER = TYPE_USER.ID_TYPE_USER");
$recupUser->execute();
$users = $recupUser->fetchAll(PDO::FETCH_ASSOC);

// Initialiser le message d'erreur
$errorMessage = "";

// Suppression de l'utilisateur
if (isset($_POST['delete_user'])) {
    // Vérifier le nombre d'utilisateurs
    $countUsersStmt = $bdd->prepare("SELECT COUNT(*) AS user_count FROM USER");
    $countUsersStmt->execute();
    $userCount = $countUsersStmt->fetch(PDO::FETCH_ASSOC)['user_count'];

    if ($userCount > 1) {
        $userIdToDelete = $_POST['ID'];
        
        // Récupérer le rôle de l'utilisateur à supprimer
        $getUserRoleStmt = $bdd->prepare("SELECT ID_TYPE_USER FROM USER WHERE ID = :ID");
        $getUserRoleStmt->execute(array(':ID' => $userIdToDelete));
        $userRole = $getUserRoleStmt->fetch(PDO::FETCH_ASSOC)['ID_TYPE_USER'];

        // Vérifier si l'utilisateur à supprimer est un administrateur différent de l'utilisateur actuel
        if ($userRole == 'A' && $userIdToDelete != $_SESSION['ID']) {
            $errorMessage = "Vous ne pouvez pas supprimer un autre administrateur.";
        } else {
            $deleteUser = $bdd->prepare("DELETE FROM USER WHERE ID = :ID");
            $deleteUser->execute(array(':ID' => $userIdToDelete));

            // Recharger les utilisateurs après la suppression
            $recupUser->execute();
            $users = $recupUser->fetchAll(PDO::FETCH_ASSOC);
        }
    } else {
        $errorMessage = "Vous ne pouvez pas supprimer cet utilisateur. Il doit rester au moins un utilisateur.";
    }
}

// Mise à jour du rôle de l'utilisateur
if (isset($_POST['update_role'])) {
    $userIdToUpdate = $_POST['ID'];
    $newRole = $_POST['ID_TYPE_USER'];

    // Vous devez mapper les rôles à leurs ID dans la table TYPE_USER
    $roleMap = [
        'A' => 'Administrateur',
        'I' => 'Ingénieur',
        'T' => 'Technicien',
    ];

    if (in_array($newRole, array_keys($roleMap))) {
        $updateRole = $bdd->prepare("UPDATE USER SET ID_TYPE_USER = :ID_TYPE_USER WHERE ID = :ID");
        $updateRole->execute(array(':ID_TYPE_USER' => $newRole, ':ID' => $userIdToUpdate));

        // Recharger les utilisateurs après la mise à jour du rôle
        $recupUser->execute();
        $users = $recupUser->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>

<!DOCTYPE html>
<html lang="fr_FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/DashboardSensorDRAC/src/Styles/img/logo-Marianne.ico" type="image/x-icon">
    <title>Liste des utilisateurs</title>
</head>
<body>
    <header>
        <?php include '../Templates/Header.php'; ?>
    </header>
    <main>
        <?php
        if (!empty($errorMessage)) {
            echo "<p style='color: red;'>$errorMessage</p>";
        }
        ?>
        <?php include '../Templates/TemplatesUsers.php'; ?>
    </main>
    <footer>
        <?php include '../Templates/Footer.html'; ?>
    </footer>
</body>
</html>
