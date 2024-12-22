<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Formations et Vidéos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css" rel="stylesheet">
    <style>
        /* Forcer le centrage du contenu */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 100%;
            padding: 20px;
        }
        .card {
            margin-top: 20px;
        }
        .nav-pills .nav-link.active {
            background-color: #007bff;
        }
    </style>
</head>
<body>
    <?php require_once 'auth.php'; ?>

    <div class="main-page">
        <!-- Menu de Navigation -->
        <div class="container mt-3">
            <ul class="nav nav-pills justify-content-center">
                <li class="nav-item">
                    <a class="nav-link active" id="add-formation-link" href="#">Ajouter une Formation</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="add-video-link" href="#">Ajouter une Vidéo</a>
                </li>
            </ul>
        </div>

        <div class="container mt-0">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <!-- Section Ajout Formation -->
                    <div id="add-formation-section" style="display:block;">
                        <div class="card shadow-sm" style="padding: 30px;border-radius: 30px;">
                            <div class="card-body">
                                <h1>Ajouter une Formation</h1>

                                <form id="add-formation-form">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Titre de la Formation:</label>
                                        <input type="text" id="title" name="title" class="form-control" >
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description:</label>
                                        <textarea id="description" name="description" class="form-control" ></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Catégorie:</label>
                                        <input type="text" id="category" name="category" class="form-control" >
                                    </div>
                                    <button type="submit" class="btn btn-lg btn-primary w-100" style="border-radius: 40px;">Ajouter la Formation</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Section Ajout Vidéo -->
                    <div id="add-video-section" style="display:none;">
                        <div class="card shadow-sm" style="padding: 30px;border-radius: 30px;">
                            <div class="card-body">
                                <h1>Ajouter une Vidéo à la Formation</h1>
                                <form id="add-video-form">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Titre de la Vidéo:</label>
                                        <input type="text" id="title" name="title" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description:</label>
                                        <textarea id="description" name="description" class="form-control" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="duration" class="form-label">Durée:</label>
                                        <input type="text" id="duration" name="duration" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="video_path" class="form-label">Chemin de la Vidéo:</label>
                                        <input type="text" id="video_path" name="video_path" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="thumbnail" class="form-label">Vignette:</label>
                                        <input type="file" name="thumbnail" id="thumbnail" accept="image/*" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="formation_id" class="form-label">Formation:</label>
                                        <select name="formation_id" id="formation_id" class="form-select" required>
                                            <!-- Options de formation ajoutées dynamiquement ici -->
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-lg btn-primary w-100" style="border-radius:40px">Ajouter la Vidéo</button>
                                </form>
                                <!-- Progress Bar -->
                                <div id="progress-container" class="mt-3" style="display: none;">
                                    <div class="progress">
                                        <div id="progress-bar" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                <!-- Section Modifier Vidéo -->
                <div id="edit-video-section" style="display:none;">
                    <div class="card shadow-sm" style="padding: 30px;border-radius: 30px;">
                        <div class="card-body">
                            <h1>Modifier une Vidéo</h1>
                            <form id="edit-video-form">
                                <input type="hidden" id="edit-video-id" name="video_id">
                                <div class="mb-3">
                                    <label for="edit-title" class="form-label">Titre de la Vidéo:</label>
                                    <input type="text" id="edit-title" name="title" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit-description" class="form-label">Description:</label>
                                    <textarea id="edit-description" name="description" class="form-control" required></textarea>
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
                                    <select name="formation_id" id="edit-formation-id" class="form-select" required>
                                        <!-- Les options de formation seront ajoutées dynamiquement ici -->
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-lg btn-primary w-100" style="border-radius: 40px;">Modifier la Vidéo</button>
                            </form>
                        </div>
                    </div>
                </div>




                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>

    <script>
        // Gérer l'état actif des onglets de navigation
        document.getElementById('add-formation-link').addEventListener('click', function() {
            document.getElementById('add-formation-section').style.display = 'block';
            document.getElementById('add-video-section').style.display = 'none';
            document.getElementById('add-formation-link').classList.add('active');
            document.getElementById('add-video-link').classList.remove('active');
        });

        document.getElementById('add-video-link').addEventListener('click', function() {
            document.getElementById('add-video-section').style.display = 'block';
            document.getElementById('add-formation-section').style.display = 'none';
            document.getElementById('add-video-link').classList.add('active');
            document.getElementById('add-formation-link').classList.remove('active');
        });




        // Soumission du formulaire pour ajouter une formation
        document.getElementById('add-formation-form').addEventListener('submit', function(e) {
            e.preventDefault(); // Empêche la soumission du formulaire classique

            let formData = new FormData(this); // Récupère les données du formulaire

            // Envoi de la requête AJAX
            fetch('add_formation.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())  // On attend une réponse en JSON
            .then(data => {
                if (data.success) {
                    iziToast.success({
                        title: 'Succès',
                        message: data.message,
                        position: 'topRight'
                    });
                    // Réinitialiser le formulaire après soumission réussie
                    document.getElementById('add-formation-form').reset();
                    loadFormations();
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

        // Fonction AJAX pour récupérer les formations
        function loadFormations() {
            fetch('get_formations.php')
                .then(response => response.json())
                .then(data => {
                    let formationSelect = document.getElementById('formation_id');
                    formationSelect.innerHTML = ''; // Réinitialiser le contenu du select

                    // Ajouter une option vide pour indiquer "Sélectionner une formation"
                    let defaultOption = document.createElement('option');
                    defaultOption.value = '';
                    defaultOption.textContent = 'Sélectionner une formation';
                    formationSelect.appendChild(defaultOption);

                    console.log('MAJ Formations...');

                    // Remplir le select avec les formations
                    data.formations.forEach(formation => {
                        let option = document.createElement('option');
                        option.value = formation.id;
                        option.textContent = formation.title;
                        formationSelect.appendChild(option);
                    });
                })
                .catch(error => console.error('Erreur lors de la récupération des formations:', error));
        }

        // Charger les formations au démarrage
        loadFormations();

        // Soumission du formulaire pour ajouter une vidéo
        document.getElementById('add-video-form').addEventListener('submit', function(e) {
        e.preventDefault(); // Empêche la soumission du formulaire classique

        const submitButton = this.querySelector('button[type="submit"]');
        submitButton.disabled = true;  // Désactiver le bouton après la soumission

        let formData = new FormData(this); // Récupère les données du formulaire

        fetch('add_video.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())  // Attente d'une réponse en JSON
        .then(data => {
            if (data.success) {
                iziToast.success({
                    title: 'Succès',
                    message: data.message,
                    position: 'topRight'
                });
                document.getElementById('add-video-form').reset();
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
        })
        .finally(() => {
            submitButton.disabled = false;  // Réactiver le bouton après l'opération
        });
    });
    </script>
</body>
</html>