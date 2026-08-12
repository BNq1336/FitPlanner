<?php

function rejestracja($polaczenie)
{
    $imie = $polaczenie->real_escape_string($_POST['frm_imie']);
    $nazwisko = $polaczenie->real_escape_string($_POST['frm_nazwisko']);
    $login = $polaczenie->real_escape_string($_POST['frm_login']);

    $sql = "SELECT *
            FROM users
            WHERE login='$login'";

    $wynik = $polaczenie->query($sql);

    if ($wynik->fetch_assoc() != null)
    {
        echo 'Taki login już istnieje';
        return;
    }

    $haslo = password_hash(
        $_POST['frm_haslo'],
        PASSWORD_DEFAULT
    );

    $sql = "INSERT INTO users
            (
                Imie,
                Nazwisko,
                Typ_user,
                login,
                haslo,
                DataUtworzenia
            )
            VALUES
            (
                '$imie',
                '$nazwisko',
                'User',
                '$login',
                '$haslo',
                NOW()
            )";

    $polaczenie->query($sql);

    echo 'Konto zostało utworzone';
    echo '<br><br>';

    echo "<a href='login.php'>
            Przejdź do logowania
          </a>";

    exit;
}

function logowanie($login, $haslo, $polaczenie)
{
    $login = $polaczenie->real_escape_string($login);

    $sql = "SELECT *
            FROM users
            WHERE login='$login'";

    $wynik = $polaczenie->query($sql);

    if (!$wynik)
    {
        echo 'Błąd zapytania';
        return;
    }

    $rekord = $wynik->fetch_assoc();

     if ($rekord && password_verify($haslo, $rekord['haslo']))
    {
        $_SESSION['el_id'] = $rekord['UserID'];
        $_SESSION['el_login'] = $rekord['login'];
        $_SESSION['el_imie'] = $rekord['Imie'];
        $_SESSION['el_nazwisko'] = $rekord['Nazwisko'];
        $_SESSION['el_typ_user'] = $rekord['Typ_user'];

        if ($rekord['Typ_user'] == 'Admin')
        {
            header('Location: ../admin/panel_admina.php');
        }
        else
        {
            header('Location: ../user/profil.php');
        }

        exit;
    }

    return 'Błędny login lub hasło';
}

function wyloguj()
{
    session_destroy();

    header('Location: login.php');
    exit;
}

function czyPustePola(...$pola)
{
    foreach ($pola as $pole)
    {
        if (trim($pole) == '')
        {
            return true;
        }
    }

    return false;
}

function wymagajLogowania()
{
    if (!isset($_SESSION['el_id']))
    {
        header('Location: ../logowanie/login.php');
        exit;
    }
}

function dodajTrening($polaczenie)
{
    $user_id = intval($_SESSION['el_id']);

    $data = $polaczenie->real_escape_string($_POST['frm_data']);

    $sql = "INSERT INTO treningi
            (
                UserID,
                Data_treningu
            )
            VALUES
            (
                $user_id,
                '$data'
            )";

    $polaczenie->query($sql);

    $id_treningu = $polaczenie->insert_id;

    if (!isset($_POST['frm_cwiczenie']))
    {
        return;
    }

    $ilosc_wpisow = count($_POST['frm_cwiczenie']);

    for ($i = 0; $i < $ilosc_wpisow; $i++)
    {
        $cwiczenie = intval($_POST['frm_cwiczenie'][$i]);
        $seria = intval($_POST['frm_seria'][$i]);
        $powtorzenia = intval($_POST['frm_powtorzenia'][$i]);
        $ciezar = floatval($_POST['frm_ciezar'][$i]);

        $sql = "INSERT INTO treningi_serie
                (
                    TreningID,
                    CwiczenieID,
                    NumerSerii,
                    Powtorzenia,
                    Ciezar
                )
                VALUES
                (
                    $id_treningu,
                    $cwiczenie,
                    $seria,
                    $powtorzenia,
                    $ciezar
                )";

        $polaczenie->query($sql);
    }

    echo 'Dodano trening';
}

function pobierzOpcjeCwiczen($polaczenie, $wybrane = null)
{
    $opcje = '';

    $sql = "SELECT * FROM cwiczenia ORDER BY Nazwa";

    $wynik = $polaczenie->query($sql);

    while ($rekord = $wynik->fetch_assoc())
    {
        $selected = '';

        if ($wybrane == $rekord['CwiczenieID'])
        {
            $selected = 'selected';
        }

        $opcje .= "
            <option value='{$rekord['CwiczenieID']}' $selected>
                {$rekord['Nazwa']}
            </option>";
    }

    return $opcje;
}

function pobierzIloscFormularzy()
{
    if (isset($_GET['ile']))
    {
        return max(1, min(20, intval($_GET['ile'])));
    }

    return 3;
}

function pobierzIdUsera()
{
    return intval($_SESSION['el_id']);
}

function sqlDaneUsera($id_usera)
{
    return "
        SELECT
            Imie,
            Nazwisko
        FROM users
        WHERE UserID = $id_usera
    ";
}

function sqlStatystykiUsera($id_usera)
{
    return "
        SELECT
            c.Nazwa AS Cwiczenie,
            c.Poziom AS Poziom,
            MAX(ts.Ciezar) AS 'Rekord (kg)',
            SUM(ts.Ciezar) AS 'Suma Podniesionego Ciężaru (kg)',
            SUM(ts.Powtorzenia) AS 'Suma Powtórzeń',
            ROUND(AVG(ts.Ciezar), 2) AS 'Średni Ciężar (kg)'
        FROM cwiczenia c
        JOIN treningi_serie ts
            ON c.CwiczenieID = ts.CwiczenieID
        JOIN treningi t
            ON ts.TreningID = t.TreningID
        WHERE t.UserID = $id_usera
        GROUP BY c.CwiczenieID
    ";
}

function pokazDaneUsera($polaczenie, $id_usera)
{
    $sql = "
        SELECT
            Imie,
            Nazwisko
        FROM users
        WHERE UserID = $id_usera
    ";

    wyswietlSql($polaczenie, $sql);
}

function pokazStatystykiUsera($polaczenie, $id_usera)
{
    $sql = "
        SELECT
            c.Nazwa AS Cwiczenie,
            c.Poziom AS Poziom,
            MAX(ts.Ciezar) AS 'Rekord (kg)',
            SUM(ts.Ciezar) AS 'Suma Podniesionego Ciężaru (kg)',
            SUM(ts.Powtorzenia) AS 'Suma Powtórzeń',
            ROUND(AVG(ts.Ciezar), 2) AS 'Średni Ciężar (kg)'
        FROM cwiczenia c
        JOIN treningi_serie ts
            ON c.CwiczenieID = ts.CwiczenieID
        JOIN treningi t
            ON ts.TreningID = t.TreningID
        WHERE t.UserID = $id_usera
        GROUP BY c.CwiczenieID
    ";

    wyswietlSql($polaczenie, $sql);
}

function wyswietlSql($polaczenie, $sql) {
    $wynik = mysqli_query($polaczenie, $sql);
    
    if (!$wynik) {
        echo "<p>Błąd w zapytaniu: " . mysqli_error($polaczenie) . "</p>";
        return;
    }

    if (mysqli_num_rows($wynik) > 0) {
        echo "<table border='1' cellpadding='5' style='border-collapse: collapse; margin-bottom: 20px;'>";
        $naglowki_wypisane = false;

        while ($wiersz = mysqli_fetch_assoc($wynik)) {
            if (!$naglowki_wypisane) {
                echo "<tr>";
                foreach (array_keys($wiersz) as $kolumna) {
                    echo "<th>" . htmlspecialchars($kolumna) . "</th>";
                }
                echo "</tr>";
                $naglowki_wypisane = true;
            }
            
            echo "<tr>";
            foreach ($wiersz as $wartosc) {
                echo "<td>" . htmlspecialchars($wartosc) . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Brak wyników w bazie.</p>";
    }
}

function pokazHistorieCwiczenia(
    $polaczenie,
    $id_usera,
    $id_cwiczenia
)
{
    $sql = "
        SELECT
            DATE_FORMAT(t.Data_treningu, '%d/%m/%Y')
                AS 'Data Treningu',

            c.Nazwa AS Cwiczenie,

            c.Poziom AS Poziom,

            SUM(ts.Ciezar)
                AS 'Suma Podniesionego Ciężaru (kg)',

            SUM(ts.Powtorzenia)
                AS 'Suma Powtórzeń',

            COUNT(ts.NumerSerii)
                AS 'Liczba Serii'

        FROM cwiczenia c

        JOIN treningi_serie ts
            ON c.CwiczenieID = ts.CwiczenieID

        JOIN treningi t
            ON ts.TreningID = t.TreningID

        WHERE
            t.UserID = $id_usera
            AND c.CwiczenieID = $id_cwiczenia

        GROUP BY
            DATE_FORMAT(t.Data_treningu, '%d/%m/%Y'),
            c.Nazwa,
            c.Poziom

        ORDER BY t.Data_treningu DESC
    ";

    wyswietlSql($polaczenie, $sql);
}

function wymagajAdmina()
{
    wymagajLogowania();

    if ($_SESSION['el_typ_user'] != 'Admin')
    {
        die('Brak uprawnień');
    }
}

function pokazTabeleUserow($polaczenie)
{
    $sql = "SELECT *
            FROM users
            ORDER BY UserID";

    $wynik = $polaczenie->query($sql);

    echo '<table border>';

    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Imię</th>';
    echo '<th>Nazwisko</th>';
    echo '<th>Login</th>';
    echo '<th>Typ użytkownika</th>';
    echo '<th>Akcja</th>';
    echo '</tr>';

    while ($rekord = $wynik->fetch_assoc())
    {
        echo '<tr>';

        echo '<td>' . htmlspecialchars($rekord['UserID']) . '</td>';
        echo '<td>' . htmlspecialchars($rekord['Imie']) . '</td>';
        echo '<td>' . htmlspecialchars($rekord['Nazwisko']) . '</td>';
        echo '<td>' . htmlspecialchars($rekord['login']) . '</td>';
        echo '<td>' . htmlspecialchars($rekord['Typ_user']) . '</td>';

        echo "<td>
                <a href='edytuj_usera.php?id={$rekord['UserID']}'>
                    Edytuj
                </a>
              </td>";

        echo '</tr>';
    }

    echo '</table>';
}

function aktualizujUsera($polaczenie)
{
    $id = intval($_POST['frm_id']);

    $imie = $polaczenie->real_escape_string($_POST['frm_imie']);
    $nazwisko = $polaczenie->real_escape_string($_POST['frm_nazwisko']);
    $login = $polaczenie->real_escape_string($_POST['frm_login']);
    $typ = $polaczenie->real_escape_string($_POST['frm_typ_user']);

    $sql = "
        UPDATE users
        SET
            Imie='$imie',
            Nazwisko='$nazwisko',
            login='$login',
            Typ_user='$typ'
        WHERE UserID=$id
    ";

    $polaczenie->query($sql);

    echo 'Dane zostały zapisane';
}

function usunUsera($polaczenie)
{
    $id = intval($_POST['frm_id']);

    if ($id == $_SESSION['el_id'])
    {
        die('Nie możesz usunąć własnego konta');
    }

    $sql = "
        DELETE FROM users
        WHERE UserID=$id
    ";

    $polaczenie->query($sql);

    echo 'Użytkownik został usunięty';
}

function pobierzUsera($polaczenie, $id)
{
    $id = intval($id);

    $sql = "
        SELECT *
        FROM users
        WHERE UserID=$id
    ";

    $wynik = $polaczenie->query($sql);

    return $wynik->fetch_assoc();
}

function pokazTabeleCwiczen($polaczenie)
{
    $sql = "SELECT *
            FROM cwiczenia
            ORDER BY Nazwa";

    $wynik = $polaczenie->query($sql);

    echo '<table border>';

    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Nazwa</th>';
    echo '<th>Poziom</th>';
	echo '<th>Typ ćwiczenia</th>';
    echo '<th>Akcja</th>';
    echo '</tr>';

    while ($rekord = $wynik->fetch_assoc())
    {
        echo '<tr>';

        echo '<td>' . $rekord['CwiczenieID'] . '</td>';
        echo '<td>' . htmlspecialchars($rekord['Nazwa']) . '</td>';
        echo '<td>' . htmlspecialchars($rekord['Poziom']) . '</td>';
		echo '<td>' . htmlspecialchars($rekord['Typ_cwiczenia']) . '</td>';

        echo "<td>
                <a href='edytuj_cwiczenie.php?id={$rekord['CwiczenieID']}'>
                    Edytuj
                </a>
              </td>";

        echo '</tr>';
    }

    echo '</table>';
}

function pobierzCwiczenie($polaczenie, $id)
{
$id = intval($id);

$sql = "SELECT *
        FROM cwiczenia
        WHERE CwiczenieID = $id";

$wynik = $polaczenie->query($sql);

return $wynik->fetch_assoc();

}

function aktualizujCwiczenie($polaczenie)
{
$id = intval($_POST['frm_id']);

$nazwa = $polaczenie->real_escape_string($_POST['frm_nazwa']);
$poziom = $polaczenie->real_escape_string($_POST['frm_poziom']);
$typ = $polaczenie->real_escape_string($_POST['frm_typ']);

$sql = "UPDATE cwiczenia
        SET
            Nazwa='$nazwa',
            Poziom='$poziom',
			Typ_cwiczenia='$typ'
        WHERE CwiczenieID=$id";

$polaczenie->query($sql);
}

function dodajCwiczenie($polaczenie)
{
    $nazwa = $polaczenie->real_escape_string($_POST['frm_nazwa']);
    $poziom = $polaczenie->real_escape_string($_POST['frm_poziom']);
    $typ = $polaczenie->real_escape_string($_POST['frm_typ']);

    $sql = "
        INSERT INTO cwiczenia
        (
            Nazwa,
            Poziom,
            Typ_cwiczenia
        )
        VALUES
        (
            '$nazwa',
            '$poziom',
            '$typ'
        )
    ";

    $polaczenie->query($sql);
}

function usunCwiczenie($polaczenie)
{
$id = intval($_POST['frm_id']);


$sql = "DELETE FROM cwiczenia
        WHERE CwiczenieID=$id";

$polaczenie->query($sql);
}

function pobierzAktualnegoUsera($polaczenie)
{
$id = intval($_SESSION['el_id']);

$sql = "
    SELECT *
    FROM users
    WHERE UserID = $id
";

$wynik = $polaczenie->query($sql);

return $wynik->fetch_assoc();

}

function aktualizujProfil($polaczenie)
{
$id = intval($_SESSION['el_id']);

$imie = $polaczenie->real_escape_string($_POST['frm_imie']);
$nazwisko = $polaczenie->real_escape_string($_POST['frm_nazwisko']);
$login = $polaczenie->real_escape_string($_POST['frm_login']);

$sql = "
    SELECT *
    FROM users
    WHERE login = '$login'
    AND UserID <> $id
";

$wynik = $polaczenie->query($sql);

if ($wynik->num_rows > 0)
{
    return 'Taki login już istnieje';
}

$sql = "
    UPDATE users
    SET
        Imie='$imie',
        Nazwisko='$nazwisko',
        login='$login'
    WHERE UserID=$id
";

$polaczenie->query($sql);

$_SESSION['el_imie'] = $imie;
$_SESSION['el_nazwisko'] = $nazwisko;
$_SESSION['el_login'] = $login;

return '';
}

function zmienHaslo($polaczenie)
{
$id = intval($_SESSION['el_id']);

if (trim($_POST['frm_haslo']) == '')
{
    return;
}

$haslo = password_hash(
    $_POST['frm_haslo'],
    PASSWORD_DEFAULT
);

$sql = "
    UPDATE users
    SET haslo='$haslo'
    WHERE UserID=$id
";

$polaczenie->query($sql);

}

function dodajPomiar($polaczenie)
{
    $user_id = intval($_SESSION['el_id']);
    
    $typ = $polaczenie->real_escape_string($_POST['frm_typ']);
    $wartosc = floatval($_POST['frm_wartosc']);
    $data = $polaczenie->real_escape_string($_POST['frm_data']);

    $sql = "INSERT INTO pomiary_usera
            (
                UserID,
                TypWymiaru,
                Wartosc,
                DataPomiaru
            )
            VALUES
            (
                $user_id,
                '$typ',
                $wartosc,
                '$data'
            )";

    $polaczenie->query($sql);

    echo 'Dodano nowy pomiar';
}

function pokazPomiaryUsera($polaczenie, $id_usera)
{
    $sql = "
        SELECT 
            TypWymiaru AS 'Typ Wymiaru',
            Wartosc AS 'Wartość',
            DataPomiaru AS 'Data Pomiaru'
        FROM pomiary_usera
        WHERE UserID = $id_usera
        ORDER BY DataPomiaru DESC
    ";

    wyswietlSql($polaczenie, $sql);
}



?>