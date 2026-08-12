<?php

session_start();

require_once '../baza/laczenie_z_baza.php';
require_once '../funkcje/funkcje.php';

wymagajAdmina();

?>

<h2>Zarządzanie użytkownikami</h2>

<a href="panel_admina.php">
    Powrót
</a>

<hr>

<?php

pokazTabeleUserow($polaczenie);

?>