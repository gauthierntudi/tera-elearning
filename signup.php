<?php
session_start();
ob_start();

if (isset($_SESSION['user_id'])) {
    header("Location: home");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

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

  <!-- izitoast -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
  <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
  <!-- izitoast -->

  <title>TERA</title>

  <style type="text/css">
    .form-page-composition {
    position: relative;
    background-image: url(img/2148844686.jpg);
    background-size: cover;
    width: 100%;
    height: 100%;
    background-position: center;
}

.form-page-composition::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: inherit;
    filter: grayscale(1);
    z-index: 1;
}

  @media (max-width: 768px) {
    .form-page-composition{
        background-image: url(img/2148844686.jpg);
        background-size: cover;
        width: 100%;
        height: 200px;
        background-position: center;
    }
  }


/* Styles du loader */
.loader-wrapper {
    display: none;  /* Par défaut, le loader est caché */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);  /* Fond semi-transparent */
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;  /* Assurez-vous qu'il est au-dessus de tout autre contenu */
    flex-direction: column; /* Aligne le loader et le texte verticalement */
}

.loader {
    border: 8px solid #f3f3f3; /* Gris clair */
    border-top: 8px solid #3498db; /* Couleur de la barre de chargement */
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 2s linear infinite; /* Animation de rotation */
}

#loading-text {
    margin-top: 10px;  /* Espacement entre le loader et le texte */
    color: white;
    font-size: 18px;
    text-align: center;
}

/* Animation de la rotation */
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

  </style>
</head>

<body class="preloader-visible" data-barba="wrapper">
  <!-- preloader start -->
  <div class="preloader js-preloader">
    <div class="preloader__bg"></div>
  </div>
  <!-- preloader end -->

  <div id="loader" class="loader-wrapper" style="display:none;">
    <div class="loader"></div>
    <p id="loading-text">Veuillez patienter...</p>
  </div>

  <main class="main-content  
  bg-beige-1
">

    <div class="content-wrapper  js-content-wrapper">

      <section class="form-page">
        <div class="form-page__img bg-dark-1">
          <div class="form-page-composition">
            
          </div>
        </div>

        <div class="form-page__content lg:py-50">
          <div class="container">
            <div class="row justify-center items-center">
              <div class="col-xl-8 col-lg-9">
                <div class="px-50 py-50 md:px-25 md:py-25 bg-white shadow-1 rounded-16">
                  <h3 class="text-30 lh-13">Créer compte</h3>
                  <p class="mt-10">Avez-vous déjà un compte? <a href="login.php" class="text-purple-1 fw-700">Se connecter</a></p>

                  <form class="contact-form respondForm__form row y-gap-20 pt-30" id="signup-form" action="#">
                    <div class="col-lg-6">
                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Nom *</label>
                        <input type="text" name="nom" placeholder="Votre nom *">
                    </div>

                    <div class="col-lg-6">
                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Postnom *</label>
                        <input type="text" name="postnom" placeholder="Votre postnom *">
                    </div>

                    <div class="col-lg-6">
                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Adresse e-mail *</label>
                        <input type="email" name="mail" placeholder="Adresse e-mail *">
                    </div>
                    <div class="col-lg-6">
                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Téléphone *</label>
                        <input type="text" name="tel" placeholder="Téléphone *">
                    </div>
                    <div class="col-lg-13">
                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Adresse physique *</label>
                        <input type="text" name="title" placeholder="Adresse physique *">
                    </div>
                    
                    <div class="col-12">
                        <button type="submit" name="submit" id="submit-signup" class="button -md -green-1 text-dark-1 fw-700 w-1/1">
                            S'inscrire
                        </button>
                    </div>
                </form>


                  <div class="lh-12 text-dark-1 fw-500 text-center mt-20">Avez-vous déjà un compte?</div>

                  <div class="d-flex x-gap-20 items-center justify-between pt-20">
                    <div class="col-12">
                      <a href="login.php" class="button -md -dark-1 text-light-5 fw-700 w-1/1">
                        Se connecter
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


    </div>
  </main>

  <!-- JavaScript -->
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
  <script src="js/vendors.js"></script>
  <script src="js/main.js"></script>
  <script src="js/fonctions.js"></script>
</body>

</html>