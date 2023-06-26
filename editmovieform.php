<?php
// funktiot käyttöön
require_once "arvostelut/components/functions.php";
include_once "arvostelut/components/header.php";
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
}

// jos saadaan mode niin ollaan tallentamassa (uutta tai vanhaa)
if (isset($_POST["mode"])) {
    // tallennus: lisääminen tai poistaminen
    $mode = $_POST["mode"];
    $nimi = $_POST['nimi'];
    $ohjaaja = $_POST['ohjaaja'];
    $kuvaus = $_POST['kuvaus'];
    $julkaisuvuosi = $_POST['julkaisuvuosi'];
     if ($mode == "edit") {
        // viimeinen lisäys: tallennetaan muutettu peli:
        $movieid = $_POST["movieID"];
        $ok = updateMovie($nimi, $ohjaaja, $kuvaus, $julkaisuvuosi, $movieid);
    }

    if ($ok) {
        header('Location: ../../index.php');
    }
}
else if (isset($_GET["editedid"])) {
    // avataan muokkaustilassa 
    $mode = "edit";
    $id = $_GET["editedid"];
    $elokuva = getMovieById($id);
?>
<a href="../../index.php">Takaisin etusivulle</a>
<div class='main-container'>
    <h3>Muokkaa peliä</h3>
<div class='sub-container'>
<form action="" method="POST">
    <input type="hidden" name="mode" value="<?= $mode ?>">
    <label for="name">Nimi: </label><br>
    <input type="text" name="nimi" id="name" value="<?=$elokuva['nimi']?>"><br>
    <label for="dir">Ohjaaja: </label><br>
    <input type="text" name="ohjaaja" id="dir" value="<?= $elokuva["ohjaaja"] ?>"><br>
    <label for="desc">Kuvaus</label><br>
    <textarea name="kuvaus" id="desc" cols="30" rows="10"><?= $elokuva['kuvaus'] ?></textarea><br>
    <label for="releaseyear">Julkaisuvuosi:</label><br>
    <input type="number" name="julkaisuvuosi" id="releaseyear" value="<?=$elokuva['julkaisuvuosi']?>"><br>
    <input type="hidden" name="movieID" value="<?= $elokuva["elokuvaID"] ?>">
    <input type="submit" value="Tallenna">
</form>
</div>
</div>
<?php
}
include_once "arvostelut/components/footer.php";
?>