<?php

session_start();

require_once '../baza/laczenie_z_baza.php';
require_once '../funkcje/funkcje.php';

wymagajAdmina();

if (isset($_POST['frm_usun']))
{
    usunUsera($polaczenie);

    header('Location: panel_admina.php');
    exit;
}

if (isset($_POST['frm_zapisz']))
{
    aktualizujUsera($polaczenie);

    header('Location: panel_admina.php');
    exit;
}

$id = intval($_GET['id']);

$rekord = pobierzUsera(
    $polaczenie,
    $id
);
?>

<h2>Edycja użytkownika</h2>

<form method="post">

<input
    type="hidden"
    name="frm_id"
    value="<?php echo $rekord['UserID']; ?>">

Imię:<br>

<input
    name="frm_imie"
    value="<?php echo htmlspecialchars($rekord['Imie']); ?>">

<br><br>

Nazwisko:<br>

<input
    name="frm_nazwisko"
    value="<?php echo htmlspecialchars($rekord['Nazwisko']); ?>">

<br><br>

Login:<br>

<input
    name="frm_login"
    value="<?php echo htmlspecialchars($rekord['login']); ?>">

<br><br>

Typ użytkownika:<br>

<select name="frm_typ_user">

    <option
        value="Admin"
        <?php echo $rekord['Typ_user'] == 'Admin' ? 'selected' : ''; ?>>
        Admin
    </option>

    <option
        value="User"
        <?php echo $rekord['Typ_user'] == 'User' ? 'selected' : ''; ?>>
        User
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

<a href="panel_admina.php">
    Powrót
</a>