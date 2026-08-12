<?php

session_start();

require_once '../baza/laczenie_z_baza.php';
require_once '../funkcje/funkcje.php';

wymagajLogowania();

$id_usera = pobierzIdUsera();

?>

<h2>Moje Pomiary</h2>

<a href="dodaj_pomiar.php">
    Dodaj nowy pomiar
</a>

<hr>

<h3>Historia wprowadzonych wymiarów:</h3>

<?php

pokazPomiaryUsera($polaczenie, $id_usera);

echo '<br><br>';

echo "<a href='profil.php'>
        Powrót
      </a>";

mysqli_close($polaczenie);

?>