<?php

session_start();

require_once '../baza/laczenie_z_baza.php';
require_once '../funkcje/funkcje.php';

wymagajLogowania();

$id_usera = pobierzIdUsera();

?>

<h2>Panel Główny</h2>

<a href="statystyki.php">
    Przejdź do analizy historycznej ćwiczeń
</a>

<hr>

<h3>Zarejestrowany użytkownik:</h3>

<?php
pokazDaneUsera($polaczenie, $id_usera);
?>

<h3>Moje ogólne statystyki:</h3>

<?php
pokazStatystykiUsera($polaczenie, $id_usera);

echo '<br><br>';

echo "<a href='profil.php'>
        Powrót
      </a>";
	  
mysqli_close($polaczenie);
?>