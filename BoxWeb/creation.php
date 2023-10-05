<?php
session_start();
require "bdd.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if($_POST['password'] == $_POST['password2']){
        $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $stmt = $conn->prepare("CALL CreationCompte(:pseudouser,:passworduser,:prenomuser)");
// Bind les paramètres
        $stmt->bindParam(":pseudouser", $_POST['username']);
        $stmt->bindParam(":prenomuser", $_POST['prenom']);
        $stmt->bindParam(":passworduser", $hashed_password);
// Exécute la requête
        if ($stmt->execute() && $stmt->rowCount() > 0) {
            header("Location: conn.php");
        } else {
            echo "Erreur lors de la creation du compte !";
        }

    }
    else{
        echo "veuiller mettre le meme mot de passe ";
    }
}
?>

<!-- Formulaire de connexion -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="username">Nom d'utilisateur :</label>
    <input type="text" name="username" required>
    <br>
    <label for="username">Prenom :</label>
    <input type="text" name="prenom" required>
    <br>
    <label for="password">Mot de passe :</label>
    <input type="password" name="password" required>
    <br>
    <label for="password">Réecrire Mot de passe :</label>
    <input type="password" name="password2" required>
    <br>
    <input type="submit" value="Creation du compte">
</form>


