<!DOCTYPE html>
<html lang="fr_FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des utilisateurs</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function updateRole(form) {
            form.submit();
        }
    </script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Liste des utilisateurs</h1>
        <form method="POST" action="AddUsers">
            <button class="btn btn-secondary mb-4" style="background-color: #000191;">Ajouter un utilisateur</button>
        </form>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Contrôle</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if (count($users) > 0) {
                    foreach ($users as $user) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($user["FIRSTNAME"]) . "</td>";
                        echo "<td>" . htmlspecialchars($user["LASTNAME"]) . "</td>";
                        echo "<td>" . htmlspecialchars($user["EMAIL"]) . "</td>";
                        echo "<td>
                                <form method='post' style='display:inline;' onsubmit='return false;'>
                                    <input type='hidden' name='ID' value='" . htmlspecialchars($user["ID"]) . "'>
                                    <select name='ID_TYPE_USER' class='form-control form-control-sm' style='display:inline-block; width:auto;' onchange='updateRole(this.form)'>
                                        <option value='A'" . ($user["ID_TYPE_USER"] == 'A' ? ' selected' : '') . ">Administrateur</option>
                                        <option value='I'" . ($user["ID_TYPE_USER"] == 'I' ? ' selected' : '') . ">Ingénieur</option>
                                        <option value='T'" . ($user["ID_TYPE_USER"] == 'T' ? ' selected' : '') . ">Technicien</option>
                                    </select>
                                    <input type='hidden' name='update_role' value='1'>
                                </form>
                                </td>";
                        echo "<td>
                                <form method='post' style='display:inline;'>
                                    <input type='hidden' name='ID' value='" . htmlspecialchars($user["ID"]) . "'>
                                    <button type='submit' name='delete_user' class='btn btn-danger btn-sm'>Supprimer</button>
                                </form>
                                </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Aucun utilisateur trouvé</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>