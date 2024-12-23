<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Assurez-vous que la session est démarrée
session_start(); 

// Inclure la fonction configs 
require_once 'configs.php';

// Gérer toutes les soumissions POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'PUT') {

    // Récupérer les données JSON envoyées par le client
    $input = file_get_contents('php://input');
    $data = json_decode($input, true); // Décoder le JSON
    $output = [];
    $status = 0;
    $statements = "INSERT INTO Quiz(formationId,title,questions) VALUES(:formationId,:title,:questions)";

    if($_SERVER['REQUEST_METHOD'] === 'PUT'){
        $statements = "UPDATE Quiz SET title=:title, questions=:questions WHERE formationId=:formationId";
    }

    // Vérifier l'action demandée
    if(isset($data['formationId'])){
        if (isset($data['title'])) {
            if(isset($data['questions'])){
                if(is_array($data['questions'])){
                    $stmt = $bdd->prepare($statements);
                    $stmt->execute([
                        ':formationId' => $data['formationId'],
                        ':title' => $data['title'],
                        ':questions' =>  json_encode($data['questions'])
                    ]);
                    
                    if($stmt->rowCount() > 0){
                        $status = 201;

                        $output['success'] = true;
                    }
                    else{
                        $status = 400;
                        $output['error'] = [
                            "message"=> "Le quiz n'a pas pu être insérée"
                        ];
                    }
                }
                else{
                    $status = 400;
                    $output["error"] = [
                        "message" => "Question doit etre un array"
                    ];
                }
            }
            else{
                $status = 400;
                $output["error"] = [
                    "message" => "Aucune question donnée"
                ];
            }
        }
        else{
            $status = 400;
            $output['error'] = [
                "message"=> "Aucun title envoyé"
            ];
        }
    }
    else{
        $status = 400;
        $output["error"] = [
            "message" => "Aucune formation envoyé"
        ];
    }

    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($output);
}
?>