<?php

session_start();

require_once '../baza/laczenie_z_baza.php';
require_once '../funkcje/funkcje.php';

wymagajLogowania();

if (isset($_POST['frm_zapisz_pomiar']))
{
    dodajPomiar($polaczenie);
    echo '<br><br>';
}

?>

<h2>Dodaj pomiar</h2>

<form method="post">

    Typ wymiaru (np. Waga, Obwód ramienia):<br>

    <input
        type="text"
        name="frm_typ"
        required>

    <br><br>

    Wartość:<br>

    <input
        type="number"
        step="0.01"
        name="frm_wartosc"
        required 
		value="0" min="0">

    <br><br>

    Data pomiaru:<br>

    <input
        type="datetime-local"
        name="frm_data"
        required>

    <br><br>

    <input
        type="submit"
        name="frm_zapisz_pomiar"
        value="Zapisz pomiar">

</form>

<br>

<a href="profil.php">
    Powrót do profilu
</a>