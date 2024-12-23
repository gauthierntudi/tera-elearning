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

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/base.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />

  <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

  <!-- Stylesheets -->
  <link rel="stylesheet" href="css/vendors.css">
  <link rel="stylesheet" href="css/main.css">

  <title>Tera - 404</title>
</head>

<body class="preloader-visible" data-barba="wrapper">
  <!-- preloader start -->
  <div class="preloader js-preloader">
    <div class="preloader__bg"></div>
  </div>
  <!-- preloader end -->


  <main class="main-content  ">

    <!-- main header -->
      <?php include('includes/header.php'); ?>
    <!-- main header -->


    <div class="content-wrapper  js-content-wrapper">

      <section class="no-page layout-pt-lg layout-pb-lg bg-beige-1">


        <div class="container">
          <div class="row y-gap-50 justify-between items-center">
            <div class="col-lg-6">
              <div class="no-page__img">
                <img src="img/404/1.svg" alt="image">
              </div>
            </div>

            <div class="col-xl-5 col-lg-6">
              <div class="no-page__content">
                <h1 class="no-page__main text-dark-2">
                  40<span class="text-purple-1">4</span>
                </h1>
                <h2 class="text-35 text-dark-2 lh-12 mt-5">Oups ! On dirait que tu es perdu.</h2>
                <div class="mt-10">La page que vous recherchez n'est pas disponible. Essayez de rechercher à nouveau ou utilisez le bouton Aller à.</div>
                <button class="button -md -purple-1 text-white mt-20">Retourner à la page d'accueil</button>
              </div>
            </div>
          </div>
        </div>
      </section>

<!-- footer -->
<?php include('includes/footer.php'); ?>
<!-- /footer -->


    </div>
  </main>

  <!-- JavaScript -->
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
  <script src="js/vendors.js"></script>
  <script src="js/main.js"></script>
</body>

</html>