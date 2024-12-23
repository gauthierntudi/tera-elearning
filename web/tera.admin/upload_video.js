document.getElementById('add-video-form').addEventListener('submit', function(e) {
    e.preventDefault(); // Empêche la soumission du formulaire classique

    let formData = new FormData(this);

    // Afficher la barre de progression
    document.getElementById('progress-container').style.display = 'block';

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'add_video.php', true);

    // Gestion de la progression du fichier
    xhr.upload.onprogress = function(e) {
        if (e.lengthComputable) {
            const percent = (e.loaded / e.total) * 100;
            document.getElementById('progress-bar').style.width = percent + '%';
        }
    };

    xhr.onload = function() {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                iziToast.success({
                    title: 'Succès',
                    message: response.message,
                    position: 'topRight'
                });
                document.getElementById('add-video-form').reset();
                document.getElementById('progress-container').style.display = 'none'; // Cacher la barre de progression
            } else {
                iziToast.error({
                    title: 'Erreur',
                    message: response.message,
                    position: 'topRight'
                });
            }
        } else {
            iziToast.error({
                title: 'Erreur',
                message: 'Une erreur est survenue, veuillez réessayer!',
                position: 'topRight'
            });
        }
    };

    xhr.send(formData); // Envoi des données
});