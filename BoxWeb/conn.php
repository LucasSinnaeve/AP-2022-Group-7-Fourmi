<?php
session_start();
require "bdd.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];
    $username = $_POST['username'];
// Préparer la requête SQL
$stmt = $conn->prepare("CALL connexion(:username)");
// Bind les paramètres
$stmt->bindParam(":username", $username);
// Exécute la requête
$stmt->execute();
// Récupérer les résultats
$user = $stmt->fetch(PDO::FETCH_ASSOC);
// Vérifier si l'utilisateur existe
if (!$user) {
    echo "Nom d'utilisateur incorrect";
} else {
    // Vérifier si le mot de passe est correct
    if (password_verify($password, $user["passworduser"])) {
        // Connexion réussie
        $_SESSION['connection'] = "kk";
        $_SESSION['iduser'] = $user["iduser"];
        echo "Connexion réussie";
        header("Location: index.php");
    } else {
        echo "Mot de passe incorrect";
    }
}
}
?>

<!-- Formulaire de connexion -->
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="username">Nom d'utilisateur :</label>
    <input type="text" name="username" required>
    <br>
    <label for="password">Mot de passe :</label>
    <input type="password" name="password" required>
    <br>
    <input type="submit" value="Se connecter">
</form>
<a href="creation.php">Pas de compte ? Appuie ici pour en créer un </a>