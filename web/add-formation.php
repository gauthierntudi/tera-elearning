<?php
session_start();
ob_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" class="-dark-mode">

<head>
<!-- Required meta tags -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="theme-color" content="#6440fb">
<link rel="icon" href="img/icon.png" type="image/png">

<!-- Google fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />


<!-- izitoast -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
  <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
  <!-- izitoast -->

<!-- Stylesheets -->
<link rel="stylesheet" href="css/vendors.css">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">

<title>Tera e-learning</title>

<style type="text/css">
  .coursesCard__image_overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    background: rgba(100, 64, 251, 1);
    opacity: 1;
}

.video-icon {
    display: flex;
    justify-content: center;
    align-items: center;
    opacity: 1!important;
}
</style>
</head>

<body class="preloader-visible" data-barba="wrapper">
<!-- preloader start -->
<div class="preloader js-preloader">
<div class="preloader__bg"></div>
</div>
<!-- preloader end -->

<!-- barba container start -->
<div class="barba-container" data-barba="container">


<main class="main-content">


<!-- main header -->
<?php include('includes/header.php'); ?>
<!-- main header -->

<div class="content-wrapper js-content-wrapper">
<div class="dashboard -home-9 px-0 js-dashboard-home-9">
  
  <!-- side bar -->
  <?php include('includes/sidebar.php'); ?>
  <!-- side bar -->

  <div class="dashboard__main mt-0">
    <div class="dashboard__content pt-0 px-15 pb-0">

      <section class="layout-pt-lg layout-pb-md">
        <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-5">
                <!-- Card Formulaire -->
                <div class="card shadow-sm">
                    <div class="card-header text-center">
                        <h1 class="text-black">Ajouter une Formation</h1>
                    </div>
                    <div class="card-body">
                        <form id="add-formation-form">
                            <div class="mb-3 row">
                                <label for="title" class="form-label col-5">Titre de la Formation:</label>
                                <input type="text" id="title" name="title" class="form-control col-7 border" >
                            </div>
                            <div class="mb-3 row">
                                <label for="description" class="form-label col-5">Description:</label>
                                <textarea id="description" name="description" class="form-control col-7" ></textarea>
                            </div>
                            <div class="mb-3 row">
                                <label for="category" class="form-label col-5">Catégorie:</label>
                                <input type="text" id="category" name="category" class="form-control col-7 border">
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
            fetch('/php/add_formation.php', {
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
                    let id = data.id;

                    location.href = '/series-'+id;
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
      </section>
    </div>

<!-- footer -->
<?php include('includes/footer.php'); ?>
<!-- /footer -->

  </div>
</div>
</div>
</main>

</div>
<!-- barba container end -->

<!-- JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="js/vendors.js"></script>
<script src="js/main.js"></script>

</body>

</html>