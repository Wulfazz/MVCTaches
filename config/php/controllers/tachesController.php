<?php

require_once '../models/database.php';
require_once '../models/tache.php'; 

class TachesController {
    private $tache;

    public function __construct() {
        $this->tache = new Tache();
    }

    // Récupération et envoi de toutes les tâches sous forme de JSON
    public function getAllTaches() {
        $taches = $this->tache->getAllTaches();
        echo json_encode($taches);
    }

    // Ajout d'une nouvelle tâche et retour du statut sous forme de JSON
    public function addTache($description, $priorite) {
        $result = $this->tache->addTache($description, $priorite);
        echo json_encode(['success' => $result]);
    }

    // Mise à jour d'une tâche existante et retour du statut sous forme de JSON
    public function updateTache($id, $description, $priorite) {
        $result = $this->tache->updateTache($id, $description, $priorite);
        echo json_encode(['success' => $result]);
    }

    // Suppression d'une tâche et retour du statut sous forme de JSON
    public function deleteTache($id) {
        $result = $this->tache->deleteTache($id);
        echo json_encode(['success' => $result]);
    }
}

// Création d'une instance du contrôleur
$controller = new TachesController();

// Traitement de la requête AJAX
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'getAll':
            $controller->getAllTaches();
            break;
        case 'add':
            if(isset($_POST['description']) && isset($_POST['priorite'])) {
                $controller->addTache($_POST['description'], $_POST['priorite']);
            }
            break;
        case 'update':
            if(isset($_POST['id']) && isset($_POST['description']) && isset($_POST['priorite'])) {
                $controller->updateTache($_POST['id'], $_POST['description'], $_POST['priorite']);
            }
            break;
        case 'delete':
            if (isset($_POST['id'])) {
                $controller->deleteTache($_POST['id']);
            }
            break;
        default:
            echo json_encode(['success' => false, 'message' => 'Action non reconnue']);
            break;
    }
} else {
    // Réponse par défaut si aucune action n'est spécifiée
    echo json_encode(['success' => false, 'message' => 'Aucune action spécifiée']);
}
