<?php

session_start();

require_once '../baza/laczenie_z_baza.php';
require_once '../funkcje/funkcje.php';

wymagajLogowania();

$id_usera = pobierzIdUsera();

$wybrane_cwiczenie =
    isset($_GET['id_cwiczenia'])
    ? intval($_GET['id_cwiczenia'])
    : null;

$opcje_cwiczen =
    pobierzOpcjeCwiczen(
        $polaczenie,
        $wybrane_cwiczenie
    );
	
?>
<h2>Szczegóły Ćwiczeń</h2>

<a href="profil.php">
    Powrót do panelu głównego
</a>

<hr>

<h3>Analiza historyczna</h3>

<form method="get">

    Wybierz ćwiczenie do analizy:<br>

    <select name="id_cwiczenia" required>

        <option
            value=""
            disabled
            <?php echo !$wybrane_cwiczenie ? 'selected' : ''; ?>>

            -- Wybierz ćwiczenie --

        </option>

        <?php echo $opcje_cwiczen; ?>

    </select>

    <input
        type="submit"
        value="Pokaż historię">

</form>

<?php

if ($wybrane_cwiczenie)
{
    echo '<h4>Historia dla wybranego ćwiczenia:</h4>';

    pokazHistorieCwiczenia(
        $polaczenie,
        $id_usera,
        $wybrane_cwiczenie
    );
}

mysqli_close($polaczenie);

?>
