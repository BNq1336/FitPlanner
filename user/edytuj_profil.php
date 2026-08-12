<?php

session_start();

require_once '../baza/laczenie_z_baza.php';
require_once '../funkcje/funkcje.php';

wymagajLogowania();

$komunikat = '';

if (isset($_POST['frm_zapisz']))
{
    $komunikat = aktualizujProfil($polaczenie);

    if ($komunikat == '')
    {
        if (!empty($_POST['frm_haslo']))
        {
            zmienHaslo($polaczenie);
        }

        $komunikat = 'Dane zostały zapisane';
    }
}

$rekord = pobierzAktualnegoUsera($polaczenie);

?>

<h2>Edycja profilu</h2>

<?php
if ($komunikat != '')
{
    echo $komunikat;
    echo '<br><br>';
}
?>

<form method="post">

Imię:<br>

<input
    type="text"
    name="frm_imie"
    value="<?php echo htmlspecialchars($rekord['Imie']); ?>"
    required>

<br><br>

Nazwisko:<br>

<input
    type="text"
    name="frm_nazwisko"
    value="<?php echo htmlspecialchars($rekord['Nazwisko']); ?>"
    required>

<br><br>

Login:<br>

<input
    type="text"
    name="frm_login"
    value="<?php echo htmlspecialchars($rekord['login']); ?>"
    required>

<br><br>

Nowe hasło:<br>

<input
    type="password"
    name="frm_haslo">

<br>

<small>
    Pozostaw puste, jeśli nie chcesz zmieniać hasła.
</small>

<br><br>

<input
    type="submit"
    name="frm_zapisz"
    value="Zapisz zmiany">

</form>

<br>

<a href="profil.php">
    Powrót do profilu
</a>
