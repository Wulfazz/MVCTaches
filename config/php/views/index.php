<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../public/css/style.css">
    <title>Gestion de Tâches</title>
    <!-- Assurez-vous d'inclure votre fichier CSS pour le style si nécessaire -->
</head>
<body>
    <div class="centerDiv">
        <h1>Gestion de Tâches</h1>

        <!-- Formulaire pour l'ajout de nouvelles tâches -->
        <form id="addTacheForm">
            <input type="text" name="description" placeholder="Description de la tâche" required>
                <select name="priorite">
                    <option value="Faible">Faible</option>
                    <option value="Moyenne">Moyenne</option>
                    <option value="Elévée">Elévée</option>
                </select>
            <button type="submit">Ajouter Tâche</button>
        </form>

        <!-- Zone pour afficher et modifier les tâches existantes -->
        <div id="tachesList">
            <!-- Les tâches chargées depuis le serveur seront affichées ici -->
        </div>

        <!-- Div pour le formulaire d'édition, qui sera rempli dynamiquement -->
        <div id="editTacheDiv"></div>
    </div>
    <!-- Inclure le script JavaScript qui gère l'AJAX et les interactions -->
    <script src="../js/script.js"></script>
</body>
</html>
