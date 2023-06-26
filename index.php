<?php
require "arvostelut/components/functions.php";
include_once "arvostelut/components/header.php";
session_start();

if (isset($_POST['logout'])) {
    // Unset all session variables
    session_unset();
    // Destroy the session
    session_destroy();
    // Redirect to the login page
    header("Location: index.php");
    exit();
}

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "<a href='login.php'>Kirjaudu sisään</a>";
    ?>
<h2>Etusivu</h2>
<a href="allmovies.php">Näytä kaikki elokuvat</a>
<?php
$arvostelut = getAllReviews();
echo "<div class='main-container'>";
$i = 0;
foreach ($arvostelut as $arvostelu) {
    echo "<div class='sub-container'>";
    echo "<h3>" . $arvostelu['elokuvaNimi'] . "</h3>";
    echo "<p class='rating'><b>Tähdet: </b> " . $arvostelu['tahdet'] . "/5</p>"; 
    echo "<p class='author'><b>Arvostelu: </b> <br>" . $arvostelu['arvostelu'] . "</p>";
    echo "<p><b>Lisäyspäivämäärä: </b> " . date("d.m.Y", strtotime($arvostelu['lisayspvm'])). "</p>";  
    echo "</div>";
    if(++$i == 5) break;
}
echo "</div>";
?>
    <?php
    exit();
} 
else {
    echo "<p>Tervetuloa, " . $_SESSION['username'] . ". Olet kirjautunut sisään. </p>";
?>
<form action="" method="post">
    <input type="hidden" name="logout" value='true'>
    <input type="submit" value="Kirjaudu ulos">
</form>
<?php
}
?>
<h1>Elokuva-arvostelut</h1>
<h2>Hallinnoi elokuvia</h2>
<a href="addmovie.php">Lisää elokuva</a>
<a href="delmovie.php">Poista elokuva</a>
<a href="editmovie.php">Muokkaa elokuvaa</a>
<h2>Hallinnoi arvosteluja</h2>
<a href="addreview.php">Lisää arvostelu</a>
<h2>Etusivu</h2>
<a href="allmovies.php">Näytä kaikki elokuvat</a>
<?php
$arvostelut = getAllReviews();
echo "<div class='main-container'>";
$i = 0;
foreach ($arvostelut as $arvostelu) {
    echo "<div class='sub-container'>";
    echo "<h3>" . $arvostelu['elokuvaNimi'] . "</h3>";
    echo "<p class='rating'><b>Tähdet: </b> " . $arvostelu['tahdet'] . "/5</p>"; 
    echo "<p class='author'><b>Arvostelu: </b> <br>" . $arvostelu['arvostelu'] . "</p>";
    echo "<p><b>Lisäyspäivämäärä: </b> " . date("d.m.Y", strtotime($arvostelu['lisayspvm'])). "</p>";  
    echo "</div>";
    if(++$i == 5) break;
}
echo "</div>";
?>
<?php
include_once "arvostelut/components/footer.php";
?>
