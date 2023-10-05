<?php
require"bdd.php";
require"header.php";
?>
<body>
  <div class="container mt-4">
    <h1>Boxes disponibles</h1>
    <table class="table">
      <thead>
        <tr>
          <th>Code</th>
          <th>Allée</th>
          <th>Côté</th>
          <th>Travée</th>
          <th>taille</th>
          <th>Prix</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Récupération des données à partir de la base de données
        $sql = "SELECT * FROM boxes WHERE datelocation < NOW()";
        $result = $conn->query($sql);

        // Affichage des données sous forme de tableau HTML
        while($row = $result->fetch()) {
            if ( $row["cote"] == "g"){
                $cote = "gauche";
            }else{
                $cote = "droite";
            }
            echo "<tr>";
            echo "<td>" . $row["code"] . "</td>";
            echo "<td>" . $row["allee"] . "</td>";
            echo "<td>" . $cote ."</td>";
            echo "<td>" . $row["travee"] . "</td>";
            echo "<td>" . $row["taille"] . ' mettre carré'. "</td>";
            echo "<td>" . $row["prix"] .' euros par mois'. "</td>";?>
                <td>
            <form method="post" action="contrat.php">
                <input type="hidden" name="idbox" value="<?php echo $row['idbox']; ?>">
                <button type="submit">Louer</button>
            </form>
                </td>
            <?php
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
require"footer.php";
?>