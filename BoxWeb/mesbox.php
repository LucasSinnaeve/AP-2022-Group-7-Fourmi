<?php
require"bdd.php";
require"header.php";
?>


<?php

?>
<body>
  <div class="container mt-4">
    <h1>Boxes disponibles</h1>
    <table class="table">
      <thead>
        <tr>
          <th>idBoxe</th>
          <th>code</th>
          <th>description</th>
          <th>Prix</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Récupération des données à partir de la base de données
        $sql = "CALL SesBox(:iduser)";
        $result = $conn->prepare($sql);
        $result->bindParam("iduser" , $_SESSION['iduser']);
        $result->execute();

        // Affichage des données sous forme de tableau HTML
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            if ( $row["cote"] == "g"){
                $cote = "gauche";
            }else{
                $cote = "droite";
            }
            echo "<tr>";
            echo "<td>" . $row["idbox"] . "</td>";
            echo "<td>" . $row["code"] . "</td>";
            echo "<td>" . $row["taille"] . "</td>";
            echo "<td>" . $row["prix"] . "</td>";
            echo "</tr>";
        }

        // Fermeture de la connexion
        $conn = null;
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>




<?php
require "footer.php";
?>