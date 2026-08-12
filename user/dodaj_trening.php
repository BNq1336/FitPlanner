<?php
session_start();

require_once '../baza/laczenie_z_baza.php';
require_once '../funkcje/funkcje.php';

wymagajLogowania();

if (isset($_POST['frm_cwiczenie']))
{
    dodajTrening($polaczenie);
}

$opcje_cwiczen = pobierzOpcjeCwiczen($polaczenie);

$ilosc_formularzy = pobierzIloscFormularzy();

?>

<form method="get">
    Ile serii/ćwiczeń chcesz dzisiaj wpisać?<br>

    <input
        type="number"
        name="ile"
        min="1"
        max="20"
        value="<?php echo $ilosc_formularzy; ?>">

    <input type="submit" value="Generuj pola">
</form>

<hr>

<h2>Dodaj trening</h2>

<form method="post">

    Data treningu:<br>

    <input
        type="datetime-local"
        name="frm_data"
        required>

    <br><br>

    <?php
    for ($i = 1; $i <= $ilosc_formularzy; $i++)
    {
        echo "<strong>Seria / Ćwiczenie $i</strong><br>";

        echo 'Ćwiczenie:<br>';
        echo '<select name="frm_cwiczenie[]">';
        echo $opcje_cwiczen;
        echo '</select><br>';

        echo 'Numer serii:<br>';
        echo '<input type="number" name="frm_seria[]" value="1" min="1"><br>';

        echo 'Powtórzenia:<br>';
        echo '<input type="number" name="frm_powtorzenia[]" value="1" min="1"><br>';

        echo 'Ciężar:<br>';
        echo '<input type="number" name="frm_ciezar[]" value="0" min="0"><br><br>';

        echo '<hr>';
    }
    ?>

    <input type="submit" value="Zapisz trening">

</form>

<br>

<a href="profil.php">Powrót</a>