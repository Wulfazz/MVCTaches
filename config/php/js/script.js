document.addEventListener('DOMContentLoaded', function() {
    loadTaches();
    document.getElementById('addTacheForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        formData.append('action', 'add');
        addTache(formData);
    });
});

function loadTaches() {
    fetch('controllers/tachesController.php', {
        method: 'POST',
        body: new URLSearchParams({'action': 'getAll'})
    })
    .then(handleResponse)
    .then(data => updateTachesList(data))
    .catch(error => console.error('Load Taches Error:', error));
}

function addTache(formData) {
    fetch('controllers/tachesController.php', {
        method: 'POST',
        body: formData
    })
    .then(handleResponse)
    .then(data => {
        if(data.success) {
            loadTaches(); // Actualiser l'affichage
        } else {
            alert('Erreur lors de l\'ajout de la tâche: ' + data.message);
        }
    })
    .catch(error => console.error('Add Tache Error:', error));
}

function deleteTache(id) {
    fetch('controllers/tachesController.php', {
        method: 'POST',
        body: new URLSearchParams({'action': 'delete', 'id': id})
    })
    .then(handleResponse)
    .then(data => {
        if(data.success) {
            loadTaches();
        } else {
            alert('Erreur lors de la suppression de la tâche.');
        }
    })
    .catch(error => console.error('Delete Tache Error:', error));
}

function updateTache(e, form, id) {
    e.preventDefault();
    const formData = new FormData(form);
    formData.append('action', 'update');
    formData.append('id', id);

    fetch('controllers/tachesController.php', {
        method: 'POST',
        body: formData
    })
    .then(handleResponse)
    .then(data => {
        if(data.success) {
            loadTaches();
            document.getElementById('editTacheDiv').innerHTML = '';
        } else {
            alert('Erreur lors de la mise à jour de la tâche.');
        }
    })
    .catch(error => console.error('Update Tache Error:', error));
}

// Handler pour vérifier la réponse et parser le JSON
function handleResponse(response) {
    if (!response.ok) throw new Error('Network response was not ok');
    return response.json().then(data => {
        if(data.success === false) throw new Error(data.message);
        return data;
    });
}

// Met à jour la liste des tâches avec les données reçues
function updateTachesList(data) {
    const tachesList = document.getElementById('tachesList');
    tachesList.innerHTML = '';
    data.forEach(tache => {
        const tacheElement = document.createElement('div');
        tacheElement.innerHTML = `
            <span>${tache.description}</span>
            <button onclick="deleteTache(${tache.id})">Supprimer</button>
            <button onclick="prepareEditTache(${tache.id}, '${tache.description}')">Modifier</button>
        `;
        tachesList.appendChild(tacheElement);
    });
}
