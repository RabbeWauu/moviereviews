<?php
function connect() {
    $servername = ;
    $username = "";
    $password = "
    //$port = 3306;
    $dbname = "";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";
        return $conn;
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        die();
    }
}

function getAllMovies() {
    $pdo = connect();
    $sql = "SELECT * FROM ht1_elokuvat";
    $stm = $pdo->query($sql);
    $elokuvat = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $elokuvat;
}

function getAllReviews() {
    $pdo = connect();
    $sql = "SELECT ht1_arvostelut.*, ht1_elokuvat.nimi AS elokuvaNimi FROM ht1_arvostelut INNER JOIN ht1_elokuvat ON ht1_arvostelut.elokuvaID = ht1_elokuvat.elokuvaID";
    $stm = $pdo->query($sql);
    $arvostelut = $stm->fetchAll(PDO::FETCH_ASSOC);
    return $arvostelut;
}

function getReviewById($id) {
    $pdo = connect();
    $sql = "SELECT ht1_arvostelut.*, ht1_elokuvat.nimi AS elokuvaNimi FROM ht1_arvostelut INNER JOIN ht1_elokuvat ON ht1_arvostelut.elokuvaID = ht1_elokuvat.elokuvaID WHERE arvosteluID=?";
    $stm = $pdo->prepare($sql);
    $stm->execute([$id]);
    $arvostelu = $stm->fetch(PDO::FETCH_ASSOC);
    return $arvostelu;
} 

function getMoviebyId($id) {
    $pdo = connect();
    $sql = "SELECT * FROM ht1_elokuvat WHERE elokuvaID=?";
    $stm = $pdo->prepare($sql);
    $stm->execute([$id]);
    $elokuva = $stm->fetch(PDO::FETCH_ASSOC);
    return $elokuva;
}  

function addReview($elokuva, $tahdet, $arvostelu, $lisayspvm) {
    $pdo = connect();
    $sql = "INSERT INTO ht1_arvostelut (`elokuvaID`, `tahdet`, `arvostelu`, `lisayspvm`) VALUES (?, ?, ?, ?);";
    $stm = $pdo->prepare($sql);
    $ok = $stm->execute([$elokuva, $tahdet, $arvostelu, $lisayspvm]);
    return $ok;
}

function addMovie($nimi, $ohjaaja, $kuvaus, $julkaisuvuosi) {
    $pdo = connect();
    $sql = "INSERT INTO ht1_elokuvat (`nimi`, `ohjaaja`, `kuvaus`, `julkaisuvuosi`) VALUES (?, ?, ?, ?);";
    $stm = $pdo->prepare($sql);
    $ok = $stm->execute([$nimi, $ohjaaja, $kuvaus, $julkaisuvuosi]);
    return $ok;
}

function deleteMovie($id) {
    $pdo = connect();
    $sql = "DELETE FROM ht1_elokuvat WHERE elokuvaID=?";
    $stm = $pdo->prepare($sql);
    $ok = $stm->execute([$id]);
    return $ok;
}

function updateMovie($nimi, $ohjaaja, $kuvaus, $julkaisuvuosi, $id) {
    $pdo = connect();
    $sql = "UPDATE ht1_elokuvat SET nimi=?, ohjaaja=?, kuvaus=?, julkaisuvuosi=? WHERE elokuvaID=?";
    $stm = $pdo->prepare($sql);
    $ok = $stm->execute([$nimi, $ohjaaja, $kuvaus, $julkaisuvuosi, $id]);
    return $ok;
}

function reviewCount() {
    $pdo = connect();
    $sql = "SELECT COUNT(*) AS count FROM ht1_arvostelut";
    $stm = $pdo->query($sql);
    $row = $stm->fetch(PDO::FETCH_ASSOC);
    $count = $row['count'];
    return $count;
}

function reviewAverage() {
    $pdo = connect();
    $sql = "SELECT AVG(tahdet) AS average FROM ht1_arvostelut";
    $stm = $pdo->query($sql);
    $row = $stm->fetch(PDO::FETCH_ASSOC);
    $average = $row['average'];
    return $average;
}

function loginUser($username, $password) {
    $validUsername = "admin";
    $validPassword = "salasana";
    if($username === $validUsername && $password === $validPassword) {
        return True;
    } else {
        return False;
    }
}
?>

