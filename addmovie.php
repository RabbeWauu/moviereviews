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
<div class='main-container'>
    <h3>Lisää elokuva</h3>
<div class='sub-container'>
<form action="" method="post">
    <label for="mname">Elokuvan nimi</label><br>
    <input type="text" name="nimi" id="mname"><br>
    <label for="mdir">Ohjaajan nimi</label><br>
    <input type="text" name="ohjaaja" id="mdir"><br>
    <label for="mdesc">Elokuvan kuvaus</label><br>
    <textarea name="kuvaus" id="mdesc" cols="30" rows="10"></textarea><br>
    <label for="mrelease">Julkaisuvuosi</label><br>
    <input type="number" name="julkaisuvuosi" id="mrelease"><br>
    <input type="submit" value="Lisää">
</form>
</div>
</div

<?php
if (isset($_POST['nimi'], $_POST['ohjaaja'], $_POST['kuvaus'], $_POST['julkaisuvuosi'])) {
    $nimi = $_POST['nimi'];
    $ohjaaja = $_POST['ohjaaja'];
    $kuvaus = $_POST['kuvaus'];
    $julkaisuvuosi = $_POST['julkaisuvuosi'];

    addMovie($nimi, $ohjaaja, $kuvaus, $julkaisuvuosi);
    header("Location: ../../index.php");
}

include_once "arvostelut/components/footer.php";
?>