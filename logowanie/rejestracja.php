<?php

require_once '../baza/laczenie_z_baza.php';
require_once '../funkcje/funkcje.php';

if
(
    isset($_POST['frm_imie']) &&
    isset($_POST['frm_nazwisko']) &&
    isset($_POST['frm_login']) &&
    isset($_POST['frm_haslo'])
)
{
    if
    (
        czyPustePola(
            $_POST['frm_imie'],
            $_POST['frm_nazwisko'],
            $_POST['frm_login'],
            $_POST['frm_haslo']
        )
    )
    {
        echo 'Wszystkie pola muszą być wypełnione';
    }
    else
    {
        rejestracja($polaczenie);
    }
}

?>

<h2>Rejestracja</h2>

<form method="post">

    Imię:<br>
    <input name="frm_imie" required><br><br>

    Nazwisko:<br>
    <input name="frm_nazwisko" required><br><br>

    Login:<br>
    <input name="frm_login" required><br><br>

    Hasło:<br>
    <input type="password" name="frm_haslo" required><br><br>

    <input type="submit" value="Zarejestruj">

</form>

<br>

<a href="login.php">
    Powrót do logowania
</a>