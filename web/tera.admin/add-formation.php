<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Formation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
</head>
<body>
    <?php require_once 'auth.php'; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-5">
                <!-- Card Formulaire -->
                <div class="card shadow-sm">
                    <div class="card-header text-center">
                        <h1>Ajouter une Formation</h1>
                    </div>
                    <div class="card-body">
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
                                <input type="text" id="category" name="category" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Ajouter la Formation</button>
                        </form>
                    </div>
                </div>
                <!-- Fin de la Card -->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>

    <script>
        document.getElementById('add-formation-form').addEventListener('submit', function(e) {
            e.preventDefault(); // Empêche la soumission du formulaire classique

            const formData = new FormData(this); // Récupère les données du formulaire

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
