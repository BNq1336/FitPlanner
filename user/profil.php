<?php

session_start();

require_once '../funkcje/funkcje.php';

wymagajLogowania();

?>

<h2>Profil użytkownika</h2>

<hr>

Witaj:
<?php echo $_SESSION['el_imie'] . ' ' . $_SESSION['el_nazwisko'];?>

<br><br>

Nazwa użytkownika:
<?php echo $_SESSION['el_login']; ?>

<br><br>

Typ konta:
<?php echo $_SESSION['el_typ_user']; ?>

<br><br>

<a href="edytuj_profil.php">
    Edytuj profil
</a>

<br><br>

<a href="dodaj_trening.php">
    Dodaj trening
</a>

<br><br>

<a href="moje_wyniki.php">
    Moje wyniki
</a>

<br><br>

<a href="dodaj_pomiar.php">
    Dodaj pomiar
</a>

<br><br>

<a href="moje_pomiary.php">
    Moje pomiary
</a>

<br><br>

<a href="../logowanie/wyloguj.php">
    Wyloguj
</a>