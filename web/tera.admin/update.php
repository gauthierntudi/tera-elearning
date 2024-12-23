<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Formation et Vidéo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Modifier une Formation ou Vidéo</h1>

        <!-- Menu de Navigation -->
        <ul class="nav nav-pills justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" id="edit-formation-link" href="#">Modifier une Formation</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="edit-video-link" href="#">Modifier une Vidéo</a>
            </li>
        </ul>

        <!-- Section Modifier Formation -->
        <div id="edit-formation-section" style="display:block;">
            <div class="card shadow-sm" style="padding: 30px; border-radius: 30px;">
                <div class="card-body">
                    <h1>Modifier une Formation</h1>
                    <form id="edit-formation-form">
                        <!-- Sélection de la Formation à modifier -->
                        <div class="mb-3">
                            <label for="edit-formation-id" class="form-label">Sélectionner la Formation:</label>
                            <select name="formation_id" id="edit-formation-id" class="form-select" required>
                                <!-- Les options de formation seront ajoutées dynamiquement ici -->
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="edit-title" class="form-label">Titre de la Formation:</label>
                            <input type="text" id="edit-title" name="title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-description" class="form-label">Description:</label>
                            <textarea id="edit-description" name="description" class="form-control" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="edit-category" class="form-label">Catégorie:</label>
                            <input type="text" id="edit-category" name="category" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-lg btn-primary w-100" style="border-radius: 40px;">Modifier la Formation</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Section Modifier Vidéo -->
        <div id="edit-video-section" style="display:none;">
            <div class="card shadow-sm" style="padding: 30px; border-radius: 30px;">
                <div class="card-body">
                    <h1>Modifier une Vidéo</h1>
                    <form id="edit-video-form">
                        <!-- Sélection de la Vidéo à modifier -->
                        <div class="mb-3">
                            <label for="edit-video-id" class="form-label">Sélectionner la Vidéo:</label>
                            <select name="video_id" id="edit-video-id" class="form-select" required>
                                <!-- Options de vidéos ajoutées dynamiquement ici -->
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="edit-video-title" class="form-label">Titre de la Vidéo:</label>
                            <input type="text" id="edit-video-title" name="title" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-video-description" class="form-label">Description:</label>
                            <textarea id="edit-video-description" name="description" class="form-control" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="edit-duration" class="form-label">Durée:</label>
                            <input type="text" id="edit-duration" name="duration" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-video-path" class="form-label">Chemin de la Vidéo:</label>
                            <input type="text" id="edit-video-path" name="video_path" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="edit-thumbnail" class="form-label">Vignette:</label>
                            <input type="file" name="thumbnail" id="edit-thumbnail" accept="image/*" class="form-control">
                            <img id="current-thumbnail" src="" alt="Vignette actuelle" style="max-width: 150px; margin-top: 10px;">
                        </div>

                        <div class="mb-3">
                            <label for="edit-formation-id" class="form-label">Formation:</label>
                            <select name="formation_id" id="edit-formation-id-video" class="form-select" required>
                                <!-- Options de formations ajoutées dynamiquement ici -->
                            </select>
                        </div>

                        <button type="submit" class="btn btn-lg btn-primary w-100" style="border-radius:40px">Modifier la Vidéo</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
    <script>
     // Fonction pour charger les formations dans le formulaire
function loadFormations() {
    fetch('get_formations.php')  // URL de votre script PHP
        .then(response => response.json())  // Traiter la réponse en JSON
        .then(data => {
            console.log('Données reçues:', data);  // Vérifiez ce qui est renvoyé par le serveur
            if (data.formations && Array.isArray(data.formations) && data.formations.length > 0) {
                let formationSelect = document.getElementById('edit-formation-id');
                let formationSelectVideo = document.getElementById('edit-formation-id-video');
                
                // Réinitialiser le contenu des sélecteurs
                formationSelect.innerHTML = ''; 
                formationSelectVideo.innerHTML = ''; 

                // Créer une option par défaut
                let defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = 'Sélectionner une formation';
                formationSelect.appendChild(defaultOption);
                formationSelectVideo.appendChild(defaultOption);

                // Ajouter les options dynamiquement
                data.formations.forEach(formation => {
                    let option = document.createElement('option');
                    option.value = formation.id;
                    option.textContent = formation.title;
                    formationSelect.appendChild(option);
                    formationSelectVideo.appendChild(option);
                });
            } else {
                iziToast.error({
                    title: 'Erreur',
                    message: 'Aucune formation trouvée.',
                    position: 'topRight'
                });
            }
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des formations:', error);
            iziToast.error({
                title: 'Erreur',
                message: 'Erreur lors du chargement des formations.',
                position: 'topRight'
            });
        });
}

// Appel de la fonction pour charger les formations dès le début
loadFormations();

// Fonction pour charger les vidéos dans les formulaires
function loadVideos() {
    fetch('get_video.php')
        .then(response => response.json())
        .then(data => {
            if (data.videos && data.videos.length > 0) {
                let videoSelect = document.getElementById('edit-video-id');
                videoSelect.innerHTML = ''; // Réinitialiser le contenu du select

                let defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = 'Sélectionner une vidéo';
                videoSelect.appendChild(defaultOption);

                data.videos.forEach(video => {
                    let option = document.createElement('option');
                    option.value = video.id;
                    option.textContent = video.title;
                    videoSelect.appendChild(option);
                });
            } else {
                iziToast.error({
                    title: 'Erreur',
                    message: 'Aucune vidéo trouvée.',
                    position: 'topRight'
                });
            }
        })
        .catch(error => {
            console.error('Erreur lors de la récupération des vidéos:', error);
            iziToast.error({
                title: 'Erreur',
                message: 'Erreur lors du chargement des vidéos.',
                position: 'topRight'
            });
        });
}

        // Lorsqu'une formation est sélectionnée, on la remplit automatiquement dans le formulaire
        document.getElementById('edit-formation-id').addEventListener('change', function() {
            let formationId = this.value;
            if (formationId) {
                fetch(`get_formation_details.php?id=${formationId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('edit-title').value = data.formation.title;
                            document.getElementById('edit-description').value = data.formation.description;
                            document.getElementById('edit-category').value = data.formation.category;
                        }
                    });
            }
        });

        // Lorsqu'une vidéo est sélectionnée, on la remplit automatiquement dans le formulaire
        document.getElementById('edit-video-id').addEventListener('change', function() {
            let videoId = this.value;
            if (videoId) {
                fetch(`get_video_details.php?id=${videoId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById('edit-video-title').value = data.video.title;
                            document.getElementById('edit-video-description').value = data.video.description;
                            document.getElementById('edit-duration').value = data.video.duration;
                            document.getElementById('edit-video-path').value = data.video.video_path;
                            document.getElementById('current-thumbnail').src = data.video.thumbnail_path;
                            document.getElementById('edit-formation-id-video').value = data.video.formation_id;
                        }
                    });
            }
        });

        // Charger les données au démarrage
        loadFormations();
        loadVideos();

        // Soumettre le formulaire pour modifier une vidéo
        document.getElementById('edit-video-form').addEventListener('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            fetch('update_video.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    iziToast.success({
                        title: 'Succès',
                        message: data.message,
                        position: 'topRight'
                    });
                    setTimeout(() => location.reload(), 2000);
                } else {
                    iziToast.error({
                        title: 'Erreur',
                        message: data.message,
                        position: 'topRight'
                    });
                }
            })
            .catch(error => {
                iziToast.error({
                    title: 'Erreur',
                    message: 'Une erreur est survenue, veuillez réessayer.',
                    position: 'topRight'
                });
            });
        });
    </script>
</body>
</html>
