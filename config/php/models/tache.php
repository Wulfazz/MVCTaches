<?php
class Tache {
    private $db;

    public function __construct() {
        $this->db = new Database(); // Assurez-vous que la classe Database est correctement incluse.
    }

    // Récupérer toutes les tâches
    public function getAllTaches() {
        $this->db->query('SELECT * FROM Taches ORDER BY id DESC');
        return $this->db->resultSet();
    }

    // Ajouter une nouvelle tâche avec priorité
    public function addTache($description, $priorite) {
        // Assurez-vous que la colonne pour la priorité existe dans votre table `Taches`
        $this->db->query("INSERT INTO Taches (description, priorite) VALUES (:description, :priorite)");
        // Liaison
        $this->db->bind(':description', $description);
        $this->db->bind(':priorite', $priorite);

        // Exécuter
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Mettre à jour une tâche existante avec priorité
    public function updateTache($id, $description, $priorite) {
        // Mise à jour pour inclure la priorité
        $this->db->query("UPDATE Taches SET description = :description, priorite = :priorite WHERE id = :id");
        // Liaison
        $this->db->bind(':id', $id);
        $this->db->bind(':description', $description);
        $this->db->bind(':priorite', $priorite);

        // Exécuter
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Supprimer une tâche
    public function deleteTache($id) {
        $this->db->query("DELETE FROM Taches WHERE id = :id");
        // Liaison
        $this->db->bind(':id', $id);

        // Exécuter
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
