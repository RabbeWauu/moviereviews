<?php
require_once "arvostelut/components/functions.php";
include_once "arvostelut/components/header.php";
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  header('Location: login.php');
  exit();
}
?>
<a href="../../index.php">Takaisin etusivulle</a>

<?php
$elokuvat = getAllMovies();
echo "<div class='main-container'>";
echo "<h3>Poista elokuva</h3>";
foreach ($elokuvat as $elokuva) {
    echo "<div class='sub-container'>";
    echo "<h3>" . $elokuva['elokuvaID'] . " - " . $elokuva['nimi'] . "</h3>";
    echo "<p><b>Ohjaaja: </b> " . $elokuva['ohjaaja'] . "</p>"; 
    echo "<p><b>Kuvaus: </b> <br>" . $elokuva['kuvaus'] . "</p>";
    echo "<p><b>Julkaisuvuosi: </b> " . $elokuva['julkaisuvuosi'] . "</p>";
    echo "<a href='delmovie.php?delete=" . $elokuva["elokuvaID"] . "'>poista</a>";  
    echo "</div>";
}
echo "</div>";

if (isset($_GET["delete"])) {
    try {
    $id = $_GET["delete"];
    $ok = deleteMovie($id);
    } catch(PDOException $e) {
      echo "Et voi poistaa elokuvaa, koska siitä on tehty jo arvostelu. <br>" . $e->getMessage();
      die();
  }
    // ohjataan sivu lataamaan uudestaan
    header("Location: ../../index.php");
  }  
include_once "arvostelut/components/footer.php";
?>