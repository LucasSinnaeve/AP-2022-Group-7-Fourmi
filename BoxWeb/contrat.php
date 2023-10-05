<?php
require"bdd.php";
session_start();
if (isset($_SESSION["connection"])){
    var_dump($_POST['idbox']);
    // Vérifie si l'ID du box est présent dans l'URL
    if (!isset($_POST['idbox'])) {
        // Redirige l'utilisateur vers la page de sélection du box
        header('Location: index.php');
        exit();
    }

// Récupère l'ID du box à partir de l'URL
    $id_box = $_POST['idbox'];

// Requête pour récupérer les informations du box
    $stmt = $conn->prepare("SELECT * FROM boxes WHERE idbox = :id_box");
    $stmt->bindParam(':id_box', $id_box);
    $stmt->execute();
    $box = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifie si le box existe
    if (!$box) {
        // Redirige l'utilisateur vers la page de sélection du box
        header('Location: index.php');
        exit();
    }

// Calcul du prix de location
    $price_per_month = $box['prix'];
    $price_six_months = $price_per_month ;
    $price_one_year = $price_per_month * 0.70;
// Traitement du formulaire de location
    if ($_SERVER['REQUEST_METHOD'] === 'POST'&& isset($_POST['Louer'])) {
        // Vérifie que la durée de location est valide

        $valid_duration = false;
        if ($_POST['duration'] === '6' || $_POST['duration'] === '12') {
            $valid_duration = true;
        }

        if ($valid_duration) {
            // Récupérer le nombre de mois depuis $_POST
            $duration = $_POST['duration'];

            // Calculer la date d'expiration en ajoutant la durée à la date d'aujourd'hui
            $dateExpiration = date('Y-m-d H:i:s', strtotime("+{$duration} months"));
            // Requête pour insérer un contrat de location dans la base de données
            $stmt = $conn->prepare("CALL updateboxes(:iduser,:idbox)");
            $stmt->bindParam(':idbox', $id_box);
            $stmt->bindParam(':iduser', $_SESSION['iduser']);

            // Exécute la requête
            $stmt->execute();

            // Redirige l'utilisateur vers la page de confirmation de location
            $sql = "UPDATE boxes SET datelocation = :dateExpiration WHERE idbox = :idbox";
            // préparer la requête
            $stmt = $conn->prepare($sql);
            // lier le paramètre de l'ID de box à la requête
            $stmt->bindParam(':idbox', $id_box);
            $stmt->bindParam(':dateExpiration', $dateExpiration);
            // exécuter la requête
            $stmt->execute();
           header('Location: index.php');
            exit();
        } else {
            // Affiche un message d'erreur si la durée de location n'est pas valide
            $error_message = 'Durée de location invalide.';
        }
    }
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Contrat de location de box <?php echo $box['code']; ?></title>
    </head>
<body>
    <h1>Contrat de location de box <?php echo $box['code']; ?></h1>
    <p>Taille du box : <?php echo $box['taille']; ?> mètres carrés</p>
    <p>Prix de location : <?php echo $box['prix']; ?> euros par mois</p>

    <?php if (isset($error_message)): ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="hidden" name="idbox" value="<?php echo $_POST['idbox']; ?>">
        <label>Durée de location :</label>
        <select name="duration">
            <option value="6">pour 6 mois (<?php echo $price_six_months; ?> euros par mois)</option>
            <option value="12">pour 12 mois = (<?php echo $price_one_year; ?> euros par mois)</option>
        </select>
        <br><br>
        <input type="submit" name="Louer" value="Louer">
    </form>
    <?php
}else {
    header("Location: conn.php");
    die();
}
