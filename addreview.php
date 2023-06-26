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
<h3>Lisää arvostelu</h3>
<div class='sub-container'>
        <form action="" method="post">
            <label for="movie">Elokuva</label><br>
            <select name="elokuva" id="movie">
                <option value="0" selected>Valitse elokuva</option>
                <?php
                $movies = getAllMovies();
                foreach ($movies as $movie) {
                    echo "<option value='" . $movie['elokuvaID'] . "'>" . $movie['nimi'] . "</option>";
                }
                ?>
            </select><br>
            <label for="stars">Tähdet</label><br>
            <input type="number" min=0 max=5 name="tahdet" id="stars" placeholder="1-5"><br>
            <label for="review">Arvostelu</label><br>
            <textarea name="arvostelu" id="review" cols="30" rows="10"></textarea><br>
            <label for="date">Lisäyspäivämäärä</label><br>
            <input type="date" name="paivamaara" id="date"><br><br>
            <input type="submit" value="Lisää arvostelu">
        </form>
</div>
</div>
<?php
if (isset($_POST['elokuva'],$_POST['tahdet'],$_POST['arvostelu'],$_POST['paivamaara']) && $_POST['elokuva'] != "0") {
    $elokuva = $_POST['elokuva'];
    $tahdet = $_POST['tahdet'];
    $arvostelu = $_POST['arvostelu'];
    $lisayspvm = $_POST['paivamaara'];

    addReview($elokuva, $tahdet, $arvostelu, $lisayspvm);
    header("Location: ../../index.php");
}

elseif (isset($_POST['elokuva']) && $_POST['elokuva'] == "0") {
        echo "Elokuva ei voi olla tyhjä";
}

include_once "arvostelut/components/footer.php";
?>