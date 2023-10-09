<?php
include("dbconnect.php");
$request_method = $_SERVER["REQUEST_METHOD"];


switch($request_method)
{
    case 'POST':
        verifierMotDePasse($db, $_POST['nomUtilisateur'], $_POST['motDePasse']);
        break;

    default:
        // Requête invalide
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

function verifierMotDePasse($db, $nomUtilisateur, $motDePasse) {

$requete = $db->prepare("SELECT mdp, id FROM user WHERE nom = ?;");
$requete->execute(array($nomUtilisateur));
$resultat = $requete->fetch(PDO::FETCH_ASSOC);

if(!$resultat) {
    $response = array(
    'status' => -1,
    'status_message' =>'Nom d\'utilisateur incorrect.'
    );
} else {
    if(password_verify($motDePasse, $resultat['mdp'])) {
        $response = array(
        'status' => 1,
        'id' => $resultat['id'],
        'status_message' =>'Mot de passe correct.'
        );
    }else {
        $response = array(
        'status' => 0,
        'status_message' =>password_hash($motDePasse, PASSWORD_DEFAULT)
        );
    }
}

header('Content-Type: application/json');
echo json_encode($response);
}

