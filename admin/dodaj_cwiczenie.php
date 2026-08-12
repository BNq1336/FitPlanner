<?php

session_start();

require_once '../baza/laczenie_z_baza.php';
require_once '../funkcje/funkcje.php';

wymagajAdmina();

if (isset($_POST['frm_zapisz']))
{
    dodajCwiczenie($polaczenie);

    header('Location: cwiczenia.php');
    exit;
}

?>

<h2>Dodaj ćwiczenie</h2>

<form method="post">

    Nazwa ćwiczenia:<br>

    <input
        type="text"
        name="frm_nazwa"
        required>

    <br><br>

    Poziom:<br>

    <select name="frm_poziom">

        <option value="podstawowy">
            podstawowy
        </option>

        <option value="sredni">
            Średni
        </option>

        <option value="zaawansowany">
            Zaawansowany
        </option>

    </select>

    <br><br>

    Typ ćwiczenia:<br>

    <select name="frm_typ">

        <option value="Wielostawowe">
            Wielostawowe
        </option>

        <option value="Izolacyjne">
            Izolacyjne
        </option>

    </select>

    <br><br>

    <input
        type="submit"
        name="frm_zapisz"
        value="Dodaj ćwiczenie">

</form>

<br>

<a href="cwiczenia.php">
    Powrót
</a>