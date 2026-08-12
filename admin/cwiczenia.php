<?php

session_start();

require_once '../baza/laczenie_z_baza.php';
require_once '../funkcje/funkcje.php';

wymagajAdmina();

?>

<h2>Zarządzanie ćwiczeniami</h2>

<a href="panel_admina.php">
    Powrót
</a>

<hr>

<a href="dodaj_cwiczenie.php">
    Dodaj nowe ćwiczenie
</a>

<br><br>

<?php

pokazTabeleCwiczen($polaczenie);

?>