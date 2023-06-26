<?php
require "arvostelut/components/functions.php";
include_once "arvostelut/components/header.php";
session_start();
echo "<p>Sinun täytyy kirjautua sisään tehdäksesi muutoksia tai arvosteluja.</p>";
?>
<a href="../../index.php">Takaisin etusivulle</a>
<div class='main-container'>
    <h2>Kirjaudu sisään</h2>
<div class='sub-container'>
    <form method="POST" action="login.php">
        <label for="username">Username: (admin)</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password: (salasana)</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</div>
</div>

<?php
if(isset($_POST['username'],$_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (loginUser($username,$password)) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
    
        header("Location: index.php");
        exit();
    } else {
        echo "Väärä käyttäjänimi tai salasana.";
    }
}
?>