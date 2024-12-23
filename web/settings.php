<!DOCTYPE html>
<html lang="en" class="-dark-mode">

<head>
<!-- Required meta tags -->
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Google fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

<!-- Stylesheets -->
<link rel="stylesheet" href="css/vendors.css">
<link rel="stylesheet" href="css/main.css">

<title>Tera e-learning</title>
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

  <div class="dashboard__main mt-60">
    <div class="dashboard__content">

        <div class="container">
          <div class="row">
            <div class="col-auto">

              <h1 class="text-30 lh-12 fw-700">Settings</h1>
              <div class="mt-10">Lorem ipsum dolor sit amet, consectetur.</div>

            </div>
          </div>
        </div>



        <div class="row y-gap-20 x-gap-20 items-center">
          <div class="col-auto">
            <img class="size-100" src="img/dashboard/edit/1.png" alt="image">
          </div>

          <div class="col-auto">
            <div class="text-16 fw-500 text-dark-1">Your avatar</div>
            <div class="text-14 lh-1 mt-10">PNG or JPG no bigger than 800px wide and tall.</div>

            <div class="d-flex x-gap-10 y-gap-10 flex-wrap pt-15">
              <div>
                <div class="d-flex justify-center items-center size-40 rounded-8 bg-light-3">
                  <div class="icon-cloud text-16"></div>
                </div>
              </div>
              <div>
                <div class="d-flex justify-center items-center size-40 rounded-8 bg-light-3">
                  <div class="icon-bin text-16"></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="border-top-light pt-30 mt-30">
          <form action="#" class="contact-form row y-gap-30">

            <div class="col-md-6">

              <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Nom</label>

              <input type="text" placeholder="Votre Nom">
            </div>


            <div class="col-md-6">

              <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Postnom</label>

              <input type="text" placeholder="Votre postnom">
            </div>


            <div class="col-md-6">

              <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Téléphone</label>

              <input type="text" placeholder="Téléphone">
            </div>


            <div class="col-md-6">

              <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Adresse e-mail</label>

              <input type="text" placeholder="Adresse e-mail">
            </div>


            <div class="col-md-12">

              <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Adresse Physique</label>

              <input type="text" placeholder="Adresse Physique">
            </div>


            <div class="col-12">
              <button class="button -md -purple-1 text-white">Modifier Profil</button>
            </div>
          </form>
        </div>



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