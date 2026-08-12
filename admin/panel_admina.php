<?php

session_start();

require_once '../baza/laczenie_z_baza.php';
require_once '../funkcje/funkcje.php';

wymagajAdmina();

?>

<h2>Panel administratora</h2>

<hr>

Zalogowany:
<?php echo htmlspecialchars($_SESSION['el_login']); ?>

<br><br>

<a href="uzytkownicy.php">
    <button type="button">
        Użytkownicy
    </button>
</a>

<br><br>

<a href="cwiczenia.php">
    <button type="button">
        Ćwiczenia
    </button>
</a>

<br><br>

<a href="../logowanie/wyloguj.php">
    <button type="button">
        Wyloguj
    </button>
</a>