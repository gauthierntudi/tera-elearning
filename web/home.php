<?php
session_start();
ob_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    exit;
}
else{
  require("php/db_connect.php");
  require("php/utils.php");

  $svgs = [
    "air-pollution.svg",
    "bar-chart-dollar.svg",
    "building-ngo.svg",
    "calculator-2.svg",
    "calculator-money.svg",
    "career-growth.svg",
    "cloud-2.svg",
    "crm-computer.svg",
    "fire-burner.svg",
    "grill-hot-alt.svg",
    "grill-hot-alt01.svg",
    "hand-taking-dollar.svg",
    "seo-monitor.svg"
  ];
  $formations = get_formations();
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
        <div data-anim-wrap class="container">
          <div class="row y-gap-20 justify-between items-center">
            <div class="col-auto">

              <div class="sectionTitle ">
                <h2 class="sectionTitle__title ">Les séries</h2>

                <p class="sectionTitle__text ">
                  Découvrez toutes les séries de formation du module Tera
                </p>
              </div>

            </div>

            <div class="col-auto">

              <div class="d-flex x-gap-15 items-center justify-center">
                <div class="col-auto">
                  <button class="d-flex items-center text-24 arrow-left-hover js-cat-slider-prev">
                    <i class="icon icon-arrow-left"></i>
                  </button>
                </div>
                <div class="col-auto">
                  <div class="pagination -arrows js-cat-slider-pag"></div>
                </div>
                <div class="col-auto">
                  <button class="d-flex items-center text-24 arrow-right-hover js-cat-slider-next">
                    <i class="icon icon-arrow-right"></i>
                  </button>
                </div>
              </div>

            </div>
          </div>

          <div class="overflow-hidden pt-50 js-section-slider" data-gap="30" data-loop data-slider-cols="xl-5 lg-4 md-3 sm-2" data-pagination="js-cat-slider-pag" data-nav-prev="js-cat-slider-prev" data-nav-next="js-cat-slider-next">
            <div class="swiper-wrapper">
              <?php
                $id = 0;
                $length = count($svgs);
                foreach ($formations as $key => $value) {
                  ?>
                  <div class="swiper-slide h-100">
                    <div data-anim-child="slide-left delay-2">
                      <a href="series-<?php echo $value['id']; ?>">
                      <div class="featureCard -type-1 -featureCard-hover-3">
                        <div class="featureCard__content">
                          <div class="featureCard__icon">
                            <img src="img/featureCards/<?php echo $svgs[$id++ % $length] ?>" style="width:50%">
                          </div>
                          <div class="featureCard__title" style="font-size: 1em;line-height: 1.17em;">
                            <?php
                              echo $value['title'];
                            ?>
                          </div>
                          <div class="featureCard__text">
                            Webinaire
                          </div>
                        </div>
                      </div>
                    </a>
                    </div>
                  </div>
                  <?php
                }
              ?>
            </div>
          </div>
        </div>
</section>




<section class="layout-pt-md layout-pb-lg" id="allFormations">
    <div data-anim="slide-left" class="container">
        <div class="row y-gap-20 items-center justify-between pb-30">
            <div class="col-12">
                <div class="sectionTitle">
                    <h2 class="sectionTitle__title">
                        Explorez les vidéos
                    </h2>
                    <p class="sectionTitle__text">
                        Explorez toutes les vidéos de différents cours de notre module de formation en ligne Tera
                    </p>
                </div>
            </div>
        </div>

        <div class="row y-gap-30" id="video-cards-container">
            <!-- Les vidéos seront ajoutées ici dynamiquement -->
        </div>

        <div class="row justify-center pt-90 lg:pt-50">
            <div class="col-auto">
                <div class="pagination -buttons">
                    <button class="pagination__button -prev" id="prev-button">
                        <i class="icon icon-chevron-left"></i>
                    </button>

                    <div class="pagination__count" id="pagination-links">
                        <!-- Les liens de pagination seront ajoutés dynamiquement ici -->
                    </div>

                    <button class="pagination__button -next" id="next-button">
                        <i class="icon icon-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
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

<script>

let currentPage = 1; // Page initiale
const videosPerPage = 12; // Nombre de vidéos par page

// Fonction pour charger les vidéos et gérer la pagination
function loadVideos(page = 1) {
    fetch(`get_videos.php?page=${page}&limit=${videosPerPage}`)
        .then(response => response.json())
        .then(data => {
            if (data.videos && data.videos.length > 0) {
                const container = document.getElementById('video-cards-container');
                container.innerHTML = ''; // Réinitialiser le contenu du conteneur

                // Ajouter les vidéos dynamiquement
                data.videos.forEach(video => {
                    const lessonCount = data.videosByFormation[video.formation_id] || 0; // Nombre de vidéos par formation
                    const videoCard = `
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <a href="series-${video.formation_id}" class="coursesCard -type-1">
                                <div class="relative">
                                    <div class="coursesCard__image overflow-hidden rounded-8">
                                        <img class="w-1/1" src="${video.thumbnail_path}" alt="image">
                                        <div class="coursesCard__image_overlay rounded-8">
                                            <div class="video-icon">
                                                <img src="img/youtube.svg" alt="Video Icon" style="width: 40px; height: 40px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="h-100 pt-15">
                                    <div class="text-17 lh-15 fw-500 text-dark-1 mt-10">${video.title}</div>
                                    <div class="d-flex x-gap-10 items-center pt-10">
                                        <div class="d-flex items-center">
                                            <div class="mr-8">
                                                <img src="img/coursesCards/icons/1.svg" alt="icon">
                                            </div>
                                            <div class="text-14 lh-1">${lessonCount} leçons</div>
                                        </div>

                                        <div class="d-flex items-center">
                                            <div class="mr-8">
                                                <img src="img/coursesCards/icons/2.svg" alt="icon">
                                            </div>
                                            <div class="text-14 lh-1">${video.duration} min</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    `;
                    container.innerHTML += videoCard;
                });

                // Mettre à jour la pagination
                updatePagination(data.totalVideos, page);
            } else {
                iziToast.error({
                    title: 'Erreur',
                    message: 'Aucune vidéo trouvée.',
                    position: 'topRight'
                });
            }
        })
        .catch(error => {
            console.error('Erreur lors du chargement des vidéos:', error);
            iziToast.error({
                title: 'Erreur',
                message: 'Erreur lors du chargement des vidéos.',
                position: 'topRight'
            });
        });
}

// Fonction pour mettre à jour les liens de pagination
function updatePagination(totalVideos, currentPage) {
    const totalPages = Math.ceil(totalVideos / videosPerPage);
    const paginationLinks = document.getElementById('pagination-links');
    paginationLinks.innerHTML = ''; // Réinitialiser les liens de pagination

    for (let i = 1; i <= totalPages; i++) {
        const pageLink = document.createElement('a');
        pageLink.href = '#';
        pageLink.textContent = i;

        // Ajouter une classe active seulement si currentPage et i sont définis et valides
        if (currentPage && i === currentPage) {
            pageLink.classList.add('active');
        }

        pageLink.addEventListener('click', (e) => {
            e.preventDefault();
            loadVideos(i);
        });
        paginationLinks.appendChild(pageLink);
    }

    // Gérer les boutons Précédent et Suivant
    document.getElementById('prev-button').disabled = currentPage === 1;
    document.getElementById('next-button').disabled = currentPage === totalPages;

    document.getElementById('prev-button').onclick = () => {
        if (currentPage > 1) {
            loadVideos(currentPage - 1);
        }
    };

    document.getElementById('next-button').onclick = () => {
        if (currentPage < totalPages) {
            loadVideos(currentPage + 1);
        }
    };
}

// Charger les vidéos et initialiser la pagination au démarrage
loadVideos(currentPage);

</script>
</body>

</html>