<?php

$polaczenie = new mysqli(
    'localhost',
    'root',
    '',
    'fitplanner'
);

if ($polaczenie->connect_error)
{
    die('Blad polaczenia z baza');
}

?>