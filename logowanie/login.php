<?php

session_start();

require_once '../baza/laczenie_z_baza.php';
require_once '../funkcje/funkcje.php';

$blad = '';

if (isset($_POST['frm_login']) && isset($_POST['frm_haslo']))
{
    $blad = logowanie(
        $_POST['frm_login'],
        $_POST['frm_haslo'],
        $polaczenie
    );
}

if (!empty($blad))
{
    echo "<p style='color:red;'>$blad</p>";
}

?>

<h2>Logowanie</h2>

<form method="post">

    Login:<br>
    <input name="frm_login"><br><br>

    Hasło:<br>
    <input type="password" name="frm_haslo"><br><br>

    <input type="submit" value="Zaloguj">

</form>

<br>

<a href="rejestracja.php">
    Rejestracja
</a>