<?php

// Se connecter à la base de données
include("dbconnect.php");
$request_method = $_SERVER["REQUEST_METHOD"];

switch($request_method)
{
    case 'POST':
        updateLoc($db);
        break;

    default:
        // Requête invalide
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function updateLoc($db){

    $requete = $db->prepare("UPDATE equipe SET latitude = ?, longitude = ? WHERE equipe.code = ?;");
    $reussi =  $requete->execute(array($_POST['latitude'], $_POST['longitude'], $_POST['codeEquipe']));

    $lignesModifiees = $requete->rowCount();

    if($reussi)
    {
        if ($lignesModifiees > 0){

            $response=array(
                'status' => 1,
                'status_message' =>'Localisation mise a jour avec succes.'
            );
        }else{
            $response=array(
                'status' => 0,
                'status_message' =>'Position identique a la precedente'
            );
        }

    }
    else
    {
        $errorInfo = $requete->errorInfo();
        $response=array(
            'status' => -1,
            'status_message' =>'ERREUR : ' . $errorInfo[2]
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
