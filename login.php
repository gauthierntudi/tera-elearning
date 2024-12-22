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
    .form-page-composition{
        background-image: url(img/15494.jpg);
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
        background-image: url(img/15494.jpg);
        background-size: cover;
        width: 100%;
        height: 200px;
        background-position: center;
    }
  }

  .otp-container {
      display: flex;
      justify-content: space-between;
      width: 100%;
      max-width: 300px;
      margin: 0 auto;
      gap: 10px; /* Espacement entre les cases */
    }

    .otp-input {
      width: 50px;
      height: 50px;
      text-align: center!important;
      font-size: 16px;
      padding: 0px!important;
      border: 1px solid #ccc;
      border-radius: 14px!important;
      font-weight: 700;
      text-transform: uppercase;
    }

    .otp-input:focus {
      outline: none;
      border-color: #4caf50;
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

      <section class="form-page js-mouse-move-container">
        <div class="form-page__img bg-dark-1">
          <div class="form-page-composition">
            
          </div>
        </div>

        <div class="form-page__content lg:py-50">
          <div class="container">
            <div class="row justify-center items-center">
              <div class="col-xl-6 col-lg-8">
                <div class="px-50 py-50 md:px-25 md:py-25 bg-white shadow-1 rounded-16">
                  <h3 class="text-30 lh-13">Se connecter</h3>
                  <p class="mt-10">Vous n'avez pas de compte? <a href="signup.php" class="text-purple-1 fw-700">Inscrivez-vous</a></p>

                  <form class="contact-form respondForm__form row y-gap-20 pt-30" id="login-form">
                    <div class="col-12">
                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Adresse e-mail</label>
                        <input type="email" name="mail" placeholder="Adresse e-mail">
                    </div>
                    <div class="col-12">
                      <div style="display:none;" id="otp-field">
                        <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Code Authentification</label>
                        <div class="otp-container">
                            <input type="text" class="otp-input" maxlength="1" id="otp-1">
                            <input type="text" class="otp-input" maxlength="1" id="otp-2">
                            <input type="text" class="otp-input" maxlength="1" id="otp-3">
                            <input type="text" class="otp-input" maxlength="1" id="otp-4">
                            <input type="text" class="otp-input" maxlength="1" id="otp-5">
                        </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" name="submit" id="submit-login" class="button -md -green-1 text-dark-1 fw-700 w-1/1">
                            Se connecter
                        </button>
                        <!-- Ajoutez un bouton de soumission OTP -->
                        <a href="#!" id="submit-otp" class="button -md -dark-3 text-dark-1 fw-700 w-1/1" style="display:none;">
                            Soumettre OTP
                        </a>
                    </div>
                </form>


                  <div class="lh-12 text-dark-1 fw-500 text-center mt-20">Si vous n'avez pas de compte</div>

                  <div class="col-12 mt-10">
                      <a href="signup.php" class="button -md -dark-1 text-light-6 w-1/1 fw-700">
                        Créer un compte
                      </a>
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
  <!-- JavaScript -->
  <script>
    const otpInputs = document.querySelectorAll('.otp-input');
    
    otpInputs.forEach((input, index) => {
      // Auto focus on next input
      input.addEventListener('input', (e) => {
        if (e.target.value.length === 1 && index < otpInputs.length - 1) {
          otpInputs[index + 1].focus();
        } else if (e.target.value.length === 0 && index > 0) {
          otpInputs[index - 1].focus();
        }
      });

      // Paste functionality
      input.addEventListener('paste', (e) => {
        const pastedData = e.clipboardData.getData('text');
        if (pastedData.length === 5) {
          otpInputs.forEach((input, i) => {
            input.value = pastedData[i];
          });
        }
      });
    });
  </script>
</body>

</html>