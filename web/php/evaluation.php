<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Assurez-vous que la session est démarrée
session_start(); 

// Inclure la fonction configs 
require_once 'configs.php';

// Gérer toutes les soumissions POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Récupérer les données JSON envoyées par le client
    $input = file_get_contents('php://input');
    $data = json_decode($input, true); // Décoder le JSON
    $output = [];
    $status = 0;
    $statements = "INSERT INTO Evaluation(abonneId,formationId,pourcentage) VALUES(:abonneId, :formationId,:pourcentage)";

    // Vérifier l'action demandée
    if(isset($data['formationId'])){
        if (isset($data['pourcentage'])) {
            $stmt = $bdd->prepare($statements);
            $stmt->execute([
                ':formationId' => $data['formationId'],
                ':abonneId' => $_SESSION['user_id'],
                ':pourcentage' =>  json_encode($data['pourcentage'])
            ]);
                    
            if($stmt->rowCount() > 0){
                $status = 201;

                $output['success'] = true;
            }
            else{
                $status = 200;
                $output['error'] = [
                    "message"=> "L'evaluation n'a pas pu être insérée"
                ];
            }
        }
        else{
            $status = 400;
            $output['error'] = [
                "message"=> "Aucun pourcentage envoyé"
            ];
        }
    }
    else{
        $status = 400;
        $output["error"] = [
            "message" => "Aucune formationId envoyé"
        ];
    }

    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($output);
}
else if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $output = [];
    $status;

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $stmt = $bdd->prepare("SELECT pourcentage,formationId FROM Evaluation WHERE formationId = :formationId ORDER BY date_added");
        $stmt->execute([
            ':formationId'=> $id
        ]);

        $evaluation = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $output = ["evaluations"=> $evaluation];
        $status = 200;
    }
    else{
        $status = 400;
        $output["error"] = [
            "message"=> "L'identifiant de la formation n'as pas été envoyé"
        ];
    }

    http_response_code($status);
    echo json_encode($output);
}
?>