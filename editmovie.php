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
echo "<h3>Muokkaa elokuvaa</h3>";
foreach ($elokuvat as $elokuva) {
    echo "<div class='sub-container'>";
    echo "<h3>" . $elokuva['elokuvaID'] . " - " . $elokuva['nimi'] . "</h3>";
    echo "<h4>Ohjaaja: " . $elokuva['ohjaaja'] . "</h4>";
    echo "<p>Kuvaus: <br>" . $elokuva['kuvaus'] . "</p>";
    echo "<p>Julkaisuvuosi: " . $elokuva['julkaisuvuosi'] . "</p>";
    echo "<a href='editmovieform.php?editedid=" . $elokuva["elokuvaID"] . "'>muokkaa</a>";  
    echo "</div>";
}
echo "</div>";
include_once "arvostelut/components/footer.php";
?>