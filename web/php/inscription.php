<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Assurez-vous que l'en-tête JSON est défini
header('Content-Type: application/json');

// Assurez-vous que la session est démarrée
session_start(); 

// Inclure la fonction configs 
require_once 'configs.php';

header('Content-Type','application/json');

// Gérer toutes les soumissions POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Récupérer les données JSON envoyées par le client
    $input = file_get_contents('php://input');
    $data = json_decode($input, true); // Décoder le JSON
    $status;
    $output = [];

    if($data){

        if(isset($data['formationId'])){
            $formationId = $data['formationId'];

            if(in_array($formationId, $_SESSION['abonnements']) == false){
                $stmt = $bdd->prepare("INSERT INTO Inscription(abonneId,formationId) VALUES (:abonneId, :formationId)");
                $stmt->execute([
                    ':abonneId'=> $_SESSION['user_id'],
                    ':formationId' => $formationId
                ]);

                if($stmt->rowCount() > 0){
                    $status = 201;
                    $output = [
                        "success"=> true
                    ];

                    array_push($_SESSION['abonnements'], $formationId);
                }
                else{
                    $status = 200;
                    $output = [
                        "error"=>[
                            "message"=> "L'inscription n'as pas pu etre effectué"
                        ]
                    ];
                }
            }
            else{
                $status = 201;
                $output = [
                    "success"=> true
                ];
            }
        }
        else{
            $status = 400;
            $output = [
                "error"=>[
                    "message"=> "Aucune id de formation trouvé"
                ]
            ];
        }
    }
    else{
        $status = 400;
        $output = [
            "error"=>[
                "message"=> "Aucune donnée envoyé"
            ]
        ];
    }

    http_response_code($status);

    echo json_encode($output);
}
else{
    http_response_code(500);
}
?>