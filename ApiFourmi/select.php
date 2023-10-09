<?php

include("dbconnect.php");
$request_method = $_SERVER["REQUEST_METHOD"];


switch ($request_method) {
    case 'POST':
        selectInfo($_POST['id']);
        break;

    default:
        // Requête invalide
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function selectInfo($id)
{

    $requete = $db->prepare("SELECT numero,numeroPatient,motif,DateMission,heureRV,lieuRV,observation,priseEnChargeSS,duree,heureDepart FROM user INNER JOIN equipe ON id = idChauffeur INNER JOIN mission ON code = codeEquipe WHERE id = ?;");
    $requete->execute(array($id));
    $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);

    if (!$resultat) {
        $response = array(
            'status' => -1,
            'status_message' => 'error sql.'
        );
    } else {
        $response = array(
            'status' => 1,
            'data' => $resultat
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
