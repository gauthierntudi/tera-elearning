<div id='addVideo' class="row justify-content-center d-none">
    <div class="col-lg-12">
        <!-- Section Ajout Vidéo -->
        <div id="add-video-section">
            <div class="card shadow-sm" style="padding: 30px;border-radius: 30px;">
                <div class="card-body">
                    <h1 class='text-center'>Ajouter une Vidéo à la Formation</h1>
                    <form id="add-video-form">
                        <div class="mb-3 row">
                            <label for="title" class="form-label col-5">Titre de la Vidéo:</label>
                            <input type="text" id="title" name="title" class="form-control col-7 border" required>
                        </div>
                        <div class="mb-3 row">
                            <label for="description" class="form-label col-5">Description:</label>
                            <textarea id="description" name="description" class="form-control col-7 border" required></textarea>
                        </div>
                        <div class="mb-3 row">
                            <label for="duration" class="form-label col-5">Durée:</label>
                            <input type="text" id="duration" name="duration" class="form-control col-7 border" required>
                        </div>
                        <div class="mb-3 row">
                            <label for="video_path" class="form-label col-5">Chemin de la Vidéo:</label>
                            <input type="text" id="video_path" name="video_path" class="form-control border col-7" required>
                        </div>
                        <div class="mb-3 row">
                            <label for="thumbnail" class="form-label col-5">Vignette:</label>
                            <input type="file" name="thumbnail" id="thumbnail" accept="image/*" class="form-control col-7" required>
                        </div>
                        <input type="hidden" name="formation_id" value="<?php echo $formationId ?>">
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
    </div>
</div>

<script type="text/javascript">
    // Soumission du formulaire pour ajouter une vidéo
        document.getElementById('add-video-form').addEventListener('submit', function(e) {
            e.preventDefault(); // Empêche la soumission du formulaire classique

            const submitButton = this.querySelector('button[type="submit"]'),
            other = document.getElementById('mainCont'),
            addVideo = document.getElementById('addVideo');

            submitButton.disabled = true;  // Désactiver le bouton après la soumission

            let formData = new FormData(this); // Récupère les données du formulaire

            fetch('/php/add_video.php', {
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
                    addVideo.className += ' d-none';
                    other.style.display = '';
                    location.reload();
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