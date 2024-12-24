<?php
session_start();
ob_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login");
    exit;
}

require_once './php/db_connect.php';  // Connexion à la base de données
require_once './php/auth.php';

// Récupérer l'ID de la formation depuis l'URL
$formationId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$is_admin = $_SESSION['isAdmin'];

// Vérifier si l'ID de la formation est valide
if ($formationId <= 0) {
    echo "Formation non trouvée. Blabla";
    echo "<pre>";
    print_r($_SERVER);
    echo "</pre>";
    exit;
}

// Récupérer les détails de la formation
$stmtFormation = $bdd->prepare("SELECT Abonnes.nom, Abonnes.postnom, Abonnes.email, Evaluation.pourcentage, Formations.title, Inscription.date_added FROM ((Formations INNER JOIN Inscription ON Formations.id = Inscription.formationId) INNER JOIN Abonnes ON Inscription.abonneId = Abonnes.id) LEFT JOIN Evaluation ON Evaluation.abonneId = Abonnes.id WHERE Formations.id = :id");
$stmtFormation->bindParam(':id', $formationId, PDO::PARAM_INT);
$stmtFormation->execute();
$stats = $stmtFormation->fetchAll(PDO::FETCH_ASSOC);

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
<link rel="stylesheet" href="/css/all.min.css" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="/css/leaflet.css" />

<!-- Stylesheets -->
<link rel="stylesheet" href="css/vendors.css">
<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/output.css">
<link rel='stylesheet' href='css/bootstrap.min.css' >
<script type="text/javascript" src='js/series_function.js'></script>
<!-- izitoast -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
  <script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
  <!-- izitoast -->
<title>Tera e-learning</title>
</head>

<body class="preloader-visible" data-barba="wrapper">
<h1><?php echo $formationId; ?></h1>
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
                  <a href="/">Home</a>
                </div>

                <div class="breadcrumbs__item text-dark-3">
                  <a href="/home">Formations</a>
                </div>

                <div class="breadcrumbs__item text-dark-3">
                  <a href="/series-<?php echo $formationId ?>"><?php echo $formation['title']; ?></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

<section class="page-header -type-5 bg-dark-0">
    <div class="page-header__bg">
        <div class="bg-image js-lazy" data-bg="img/event-single/bg.png"></div>
    </div>
    <div id='quiz' class="bg-white w-full relative">

    </div> 

    <?php
       include('includes/add-video.php');
    ?>   

    <div id='mainCont' class="container">
        <div class="d-flex x-gap-15 y-gap-10 pb-20">
            <div>
                <div class="badge px-15 py-8 text-11 bg-purple-1 text-white fw-400">Rapport</div>
            </div>
        </div>
        <div class="page-header__content py-4">
            <div class="row">
                <div class='col-10 text-white'>
                    <h3><?php echo $stats[0]['title'] ?></h3>
                </div>
                <div class="col-2 text-end btn btn-primary">
                    <button id='print'>Imprimer</button>
                </div>
            </div>
        </div>
        <table class='table text-white'>
            <thead>
                <tr>
                    <?php
                    $cols = ["noms","email", "pourcentage","date inscription"];

                    foreach ($cols as $key => $value) {
                        echo "<th class='text-white text-capitalize' scope='col'>$value</th>";

                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($stats as $key => $value) {
                    $noms = $value['nom'].' '.$value['postnom'];
                    $email = $value['email'];
                    $pourcentage = $value['pourcentage'];
                    $date_added = $value['date_added'];
                    $pourcentage_class;

                    if($pourcentage > 50){
                        $pourcentage_class = 'text-success';
                    }
                    else if($pourcentage < 50){
                        if($pourcentage > 40){
                            $pourcentage_class = 'text-warning';
                        }
                        else{
                            $pourcentage_class = 'text-danger';
                        }
                    }
                    else{
                        $pourcentage_class = 'text-info';
                    }
                    ?>
                <tr>
                    <td><?php echo $noms ?></td>
                    <td><?php echo $email ?></td>
                    <td class='<?php echo $pourcentage_class ?>'><?php echo $pourcentage ?></td>
                    <td><?php echo $date_added ?></td>
                </tr>
                    <?php
                }

                ?>
            </tbody>
        </table>
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
<script src="/js/chart.min.js" referrerpolicy="no-referrer"></script>
<script src="/js/leaflet.js"></script>
<script src="js/vendors.js"></script>
<script src="js/main.js"></script>
<script src="/js/jquery-3.2.1.slim.min.js"></script>
<script src="/js/popper.min.js"></script>
<script type="text/javascript" src='/js/bootstrap.min.js'></script>
<script crossorigin src="/js/react.development.js"></script>
<script crossorigin src="/js/react-dom.development.js"></script>
<script type="text/javascript" src='/js/quiz.js'></script>
<script type="text/javascript" src='/js/xlsx.full.min.js'></script>
<script type="text/javascript">
    var stats = <?php echo json_encode($stats); ?>,
    print_node = document.getElementById('print');

    print_node.onclick = function(event){
        event.preventDefault();

        const worksheet = XLSX.utils.json_to_sheet(stats),
        workbook = XLSX.utils.book_new();

        XLSX.utils.book_append_sheet(workbook, worksheet,"Rapports-Tera");

        XLSX.writeFile(workbook,"Rapports-Tera.xlsx");
    }
</script>
</body>

</html>