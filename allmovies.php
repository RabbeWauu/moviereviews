<?php
require_once "arvostelut/components/functions.php";
include_once "arvostelut/components/header.php";
$rowCount = reviewCount();
$rowAverage = reviewAverage();
?>
<a href="../../index.php">Takaisin etusivulle</a>
<h2>Kaikki elokuvat</h2>
<h3>Arvosteluja tehty yhteensä: <?=$rowCount?></h3>
<h3>Tähtien keskiarvo: <?=$rowAverage?></h3>
<?php

$elokuvat = getAllMovies();
echo "<div class='main-container'>";
foreach ($elokuvat as $elokuva) {
    echo "<div class='sub-container'>";
    echo "<h3>" . $elokuva['nimi'] . "</h3>";
    echo "<p><b>Ohjaaja: </b> " . $elokuva['ohjaaja'] . "</p>"; 
    echo "<p><b>Kuvaus: </b> <br>" . $elokuva['kuvaus'] . "</p>";
    echo "<p><b>Julkaisuvuosi: </b> " . $elokuva['julkaisuvuosi'] . "</p>";
    echo "</div>";
}
echo "</div>";
include_once "arvostelut/components/footer.php";
?>