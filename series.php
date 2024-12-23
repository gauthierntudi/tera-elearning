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

  <div class="dashboard__main mt-0">
    <div class="dashboard__content pt-0 px-15 pb-0">

<section data-anim="fade" class="breadcrumbs" style="background: rgba(0, 0, 0, 0);">
        <div class="container">
          <div class="row">
            <div class="col-auto">
              <div class="breadcrumbs__content">

                <div class="breadcrumbs__item text-dark-3">
                  <a href="#">Home</a>
                </div>

                <div class="breadcrumbs__item text-dark-3">
                  <a href="#">All courses</a>
                </div>

                <div class="breadcrumbs__item text-dark-3">
                  <a href="#">User Experience Design</a>
                </div>

                <div class="breadcrumbs__item text-dark-3">
                  <a href="#">User Interface</a>
                </div>

              </div>
            </div>
          </div>
        </div>
      </section>



<?php
require_once './php/db_connect.php';  // Connexion à la base de données

// Récupérer l'ID de la formation depuis l'URL
$formationId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Vérifier si l'ID de la formation est valide
if ($formationId <= 0) {
    echo "Formation non trouvée.";
    exit;
}

// Récupérer les détails de la formation
$stmtFormation = $bdd->prepare("SELECT * FROM Formations WHERE id = :id");
$stmtFormation->bindParam(':id', $formationId, PDO::PARAM_INT);
$stmtFormation->execute();
$formation = $stmtFormation->fetch(PDO::FETCH_ASSOC);

// Vérifier si la formation existe
if (!$formation) {
    echo "Formation non trouvée.";
    exit;
}

// Récupérer les vidéos associées à cette formation
$stmtVideos = $bdd->prepare("SELECT id, title, duration, thumbnail_path FROM Videos WHERE formation_id = :formation_id");
$stmtVideos->bindParam(':formation_id', $formationId, PDO::PARAM_INT);
$stmtVideos->execute();
$videos = $stmtVideos->fetchAll(PDO::FETCH_ASSOC);

// Calculer la durée totale (en minutes) en sommant les durées de toutes les vidéos
$totalDuration = 0;
foreach ($videos as $video) {
    $totalDuration += (int)$video['duration']; // Assurez-vous que la durée est en minutes
}

// Compter le nombre de vidéos associées à cette formation
$videosCount = count($videos);

// Sélectionner la première vidéo pour l'afficher comme vidéo principale
$firstVideo = $videosCount > 0 ? $videos[0] : null;

// Affichage du contenu HTML
?>

<section class="page-header -type-5 bg-dark-0">
    <div class="page-header__bg">
        <div class="bg-image js-lazy" data-bg="img/event-single/bg.png"></div>
    </div>

    <div class="container">
        <div class="page-header__content pt-80 pb-90">
            <div class="row y-gap-30 justify-between">
                <div class="col-xl-6 col-lg-6">
                    <div class="d-flex x-gap-15 y-gap-10 pb-20">
                        <div>
                            <div class="badge px-15 py-8 text-11 bg-dark-5 text-dark-1 fw-400">FORMATION</div>
                        </div>
                        <div>
                            <div class="badge px-15 py-8 text-11 bg-orange-1 text-white fw-400">VIDEO</div>
                        </div>
                        <div>
                            <div class="badge px-15 py-8 text-11 bg-purple-1 text-white fw-400">TERA</div>
                        </div>
                    </div>

                    <div data-anim="slide-up delay-1">
                        <h1 class="text-30 lh-14 text-white pr-60 lg:pr-0"><?php echo $formation['title']; ?></h1>
                    </div>

                    <p class="text-dark-3 mt-20"><?php echo $formation['description']; ?></p>

                    <div class="d-flex items-center pt-20">
                        <div class="bg-image size-30 rounded-full js-lazy" data-bg="img/icon.png"></div>
                        <div class="text-14 lh-1 ml-10 text-dark-3">Module de Formation Tera</div>
                    </div>

                    <div class="mt-30">
                        <div class="d-flex justify-between py-8 border-bottom-light-2">
                            <div class="d-flex items-center text-white">
                                <div class="icon-video-file"></div>
                                <div class="ml-10">Lessons</div>
                            </div>
                            <div class="text-white"><?php echo $videosCount; ?></div>
                        </div>

                        <div class="d-flex justify-between py-8 border-bottom-light-2">
                            <div class="d-flex items-center text-white">
                                <div class="icon-puzzle"></div>
                                <div class="ml-10">Quizzes</div>
                            </div>
                            <div class="text-white">3</div>
                        </div>

                        <div class="d-flex justify-between py-8 border-bottom-light-2">
                            <div class="d-flex items-center text-white">
                                <div class="icon-clock-2"></div>
                                <div class="ml-10">Duration</div>
                            </div>
                            <div class="text-white"><?php echo $totalDuration; ?> minutes</div> <!-- Affichage de la durée totale -->
                        </div>

                        <div class="d-flex justify-between py-8 border-bottom-light-2">
                            <div class="d-flex items-center text-white">
                                <div class="icon-bar-chart-2"></div>
                                <div class="ml-10">Skill level</div>
                            </div>
                            <div class="text-white">Standard</div>
                        </div>

                        <div class="d-flex justify-between py-8 border-bottom-light-2">
                            <div class="d-flex items-center text-white">
                                <div class="icon-translate"></div>
                                <div class="ml-10">Language</div>
                            </div>
                            <div class="text-white">Anglais, Français</div>
                        </div>

                        <div class="d-flex justify-between py-8 border-bottom-light-2">
                            <div class="d-flex items-center text-white">
                                <div class="icon-badge"></div>
                                <div class="ml-10">Certificate</div>
                            </div>
                            <div class="text-white">Yes</div>
                        </div>

                        <div class="d-flex justify-between py-8 border-bottom-light-2">
                            <div class="d-flex items-center text-white">
                                <div class="icon-infinity"></div>
                                <div class="ml-10">Full lifetime access</div>
                            </div>
                            <div class="text-white">Yes</div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-5 col-lg-6">
                    <!-- Vidéo principale sélectionnée de manière aléatoire -->
                    <div class="relative">
                        <?php if ($firstVideo): ?>
                            <img class="w-1/1" src="<?php echo $firstVideo['thumbnail_path']; ?>" style="border-radius: 20px;">
                            <div class="absolute-full-center d-flex justify-center items-center">
                                <a href="video-<?php echo $firstVideo['id']; ?>" class="d-flex justify-center items-center size-60 rounded-full bg-white">
                                    <div class="icon-play text-18"></div>
                                </a>
                            </div>
                        <?php else: ?>
                            <p>Aucune vidéo disponible pour cette formation.</p>
                        <?php endif; ?>
                    </div>

                    <div class="mt-30">
                        <div class="d-flex justify-between items-center">
                            <div class="text-24 lh-1 text-white fw-700"><?php echo $formation['title']; ?></div>
                        </div>

                        <div class="row x-gap-30 y-gap-20 pt-30">
                            <!-- Afficher les vidéos -->
                            <?php foreach ($videos as $video): ?>
                                <div class="d-flex justify-between">
                                    <div class="d-flex items-center">
                                        <div class="d-flex justify-center items-center size-30 rounded-full bg-purple-3 mr-10">
                                            <div class="icon-play text-9"></div>
                                        </div>
                                        <div><?php echo $video['title']; ?></div>
                                    </div>

                                    <div class="d-flex x-gap-20 items-center">
                                        <a href="video-<?php echo $video['id']; ?>" class="text-14 lh-1 text-purple-1 underline"><?php echo $video['duration']; ?> min</a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="row x-gap-30 y-gap-20 pt-30">
                            <div class="col-sm-12">
                                <button class="button -md -outline-green-1 text-green-1 w-1/1">EVALUATION</button>
                            </div>
                            <div class="col-sm-12">
                                <button class="button -md -purple-1 text-white w-1/1">AJOUTER FAVORIS</button>
                            </div>
                        </div>
                    </div>
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
</body>

</html>