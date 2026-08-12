<?php

session_start();

require_once '../baza/laczenie_z_baza.php';
require_once '../funkcje/funkcje.php';

wymagajAdmina();

if (isset($_POST['frm_usun']))
{
    usunCwiczenie($polaczenie);

    header('Location: cwiczenia.php');
    exit;
}

if (isset($_POST['frm_zapisz']))
{
    aktualizujCwiczenie($polaczenie);

    header('Location: cwiczenia.php');
    exit;
}

if (!isset($_GET['id']))
{
    header('Location: cwiczenia.php');
    exit;
}

$rekord = pobierzCwiczenie(
    $polaczenie,
    $_GET['id']
);

?>

<h2>Edycja ćwiczenia</h2>

<form method="post">

<input
    type="hidden"
    name="frm_id"
    value="<?php echo $rekord['CwiczenieID']; ?>">

Nazwa ćwiczenia:<br>

<input
    name="frm_nazwa"
    value="<?php echo htmlspecialchars($rekord['Nazwa']); ?>">

<br><br>

Poziom:<br>

<select name="frm_poziom">

    <option
        value="podstawowy"
        <?php echo $rekord['Poziom'] == 'podstawowy' ? 'selected' : ''; ?>>
        podstawowy
    </option>

    <option
        value="Średni"
        <?php echo $rekord['Poziom'] == 'Średni' ? 'selected' : ''; ?>>
        Średni
    </option>

    <option
        value="Zaawansowany"
        <?php echo $rekord['Poziom'] == 'Zaawansowany' ? 'selected' : ''; ?>>
        Zaawansowany
    </option>

</select>

<br><br>

<select name="frm_typ">

    <option
        value="Wielostawowe"
        <?php echo $rekord['Typ_cwiczenia'] == 'Wielostawowe' ? 'selected' : ''; ?>>
        Wielostawowe
    </option>

    <option
        value="Izolacyjne"
        <?php echo $rekord['Typ_cwiczenia'] == 'Izolacyjne' ? 'selected' : ''; ?>>
        Izolacyjne
    </option>

</select>

<br><br>

<input
    type="submit"
    name="frm_zapisz"
    value="Zapisz">

<input
    type="submit"
    name="frm_usun"
    value="Usuń">

</form>

<br>

<a href="cwiczenia.php">
    Powrót
</a>
