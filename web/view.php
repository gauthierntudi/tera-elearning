<?php
session_start();
ob_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    exit;
}

require_once 'php/db_connect.php';  // Connexion à la base de données

// Récupérer l'ID de la vidéo depuis l'URL
$videoId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Vérifier si l'ID de la vidéo est valide
if ($videoId <= 0) {
echo "Vidéo non trouvée.";
exit;
}

// Récupérer les détails de la vidéo
$stmtVideo = $bdd->prepare("SELECT * FROM Videos WHERE id = :id");
$stmtVideo->bindParam(':id', $videoId, PDO::PARAM_INT);
$stmtVideo->execute();
$video = $stmtVideo->fetch(PDO::FETCH_ASSOC);

// Vérifier si la vidéo existe
if (!$video) {
echo "Vidéo non trouvée.";
exit;
}

// Récupérer les détails de la formation associée
$stmtFormation = $bdd->prepare("SELECT * FROM Formations WHERE id = :formation_id");
$stmtFormation->bindParam(':formation_id', $video['formation_id'], PDO::PARAM_INT);
$stmtFormation->execute();
$formation = $stmtFormation->fetch(PDO::FETCH_ASSOC);
$video_url = $video['video_path'];
?>

<!DOCTYPE html>
<html lang="en" class="-dark-mode">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="theme-color" content="#6440fb">
<link rel="icon" href="img/icon.png" type="image/png">

<title>Visionner la vidéo - Tera e-learning</title>

<!-- Video.js CSS -->
<link href="https://vjs.zencdn.net/7.10.2/video-js.css" rel="stylesheet">

<link rel="stylesheet" href="css/vendors.css">
<link rel="stylesheet" href="css/main.css">

<style>
/* Personnalisation du lecteur vidéo */
.vjs-control-bar {
background-color: rgba(0, 0, 0, 0.6) !important;
}
.vjs-play-control, .vjs-progress-holder, .vjs-volume-level {
background-color: #6440fb !important;
}

#video-player {
    width: 100%;
    max-width: 100%;
    background-color: transparent;
    border-radius: 8px;
}

.video-js {
    width: 100%;
    max-width: 100%;
    height: 300px;
    object-fit: cover;
}

.container {
    height: 100%;

}

.page-header__content {
    padding: 0;
}
</style>
</head>
<body class="preloader-visible" data-barba="wrapper">


<!-- preloader start -->
<div class="preloader js-preloader">
<div class="preloader__bg"></div>
</div>
<!-- preloader end -->


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

<div class="dashboard__main mt-50">
<div class="dashboard__content pt-0 px-15 pb-0">
<section class="page-header -type-5 bg-dark-0">
<div class="page-header__bg">
    <div class="bg-image js-lazy" data-bg="img/event-single/bg.png"></div>
</div>

<div class="container">
    <div class="page-header__content pt-80 pb-90">
        <div class="row y-gap-30 justify-between">
            <div class="col-xl-6 col-lg-6">
                <!-- Vidéo Player personnalisé avec Video.js -->
                <video id="video-player" class="video-js vjs-default-skin vjs-big-play-centered" controls>
                    <source id='video-source' type="video/mp4">
                    Votre navigateur ne supporte pas la lecture de vidéos.
                </video>

                <!-- Titre sous la vidéo -->
                <div class="video-title mt-20 text-white">
                    <h4>
                        <?php echo $video['title']; ?>
                    </h4>
                    <p class="text-dark-3 mt-20"><?php echo $video['description']; ?></p>
                </div>
            </div>

            <div class="col-xl-5 col-lg-6">
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
                <div class="mt-0">
                    <div class="d-flex justify-between items-center">
                        <div class="text-24 lh-1 text-white fw-700">
                        <?php echo $formation['title']; ?>
                        </div>
                    </div>

                    <div class="row x-gap-30 y-gap-20 pt-30">
                        <!-- Liste des vidéos de la même formation -->
                        <?php
                        $stmtVideos = $bdd->prepare("SELECT id, title, duration FROM Videos WHERE formation_id = :formation_id");
                        $stmtVideos->bindParam(':formation_id', $formation['id'], PDO::PARAM_INT);
                        $stmtVideos->execute();
                        $videos = $stmtVideos->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($videos as $video) {
                        ?>
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
                        <?php } ?>
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



<!-- Video.js JS -->
<script src="https://vjs.zencdn.net/7.10.2/video.js"></script>

<!-- JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="js/vendors.js"></script>
<script src="js/main.js"></script>

<script>


var video_source = document.getElementById('video-source');

video_source.src = "<?php echo $video_url; ?>";

setTimeout(()=>{
    // Initialiser le lecteur vidéo avec Video.js
    var player = videojs('video-player', {
    controls: true,
    autoplay: true,
    preload: 'auto',
    theme: '#6440fb',  // Personnalisation de la couleur du thème
    controlBar: {
    playToggle: true,
    volumePanel: true,
    fullscreenToggle: true,
    progressControl: true,
    currentTimeDisplay: true,
    timeDivider: true,
    durationDisplay: true,
    },
    });

    // Ajouter des boutons personnalisés pour avancer et reculer de 10 secondes
    var skipForward = document.createElement('button');
    skipForward.innerHTML = '▶ 10s';
    skipForward.classList.add('vjs-control');
    skipForward.addEventListener('click', function () {
    player.currentTime(player.currentTime() + 10);  // Avancer de 10 secondes
    });

    var skipBackward = document.createElement('button');
    skipBackward.innerHTML = '◀ 10s';
    skipBackward.classList.add('vjs-control');
    skipBackward.addEventListener('click', function () {
    player.currentTime(player.currentTime() - 10);  // Reculer de 10 secondes
    });

    // Ajouter ces boutons au lecteur
    var controls = document.querySelector('.vjs-control-bar');
    controls.insertBefore(skipBackward, controls.firstChild);
    controls.appendChild(skipForward);
},50);
</script>

</body>
</html>
