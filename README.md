# FitPlanner
## Opis projektu
**FitPlanner** to aplikacja webowa służąca do planowania, zapisywania i monitorowania treningów.
Projekt został wykonany w ramach projektu uczelnianego przez dwuosobowy zespół. Aplikacja działa lokalnie z wykorzystaniem środowiska XAMPP, serwera Apache oraz bazy danych MySQL.
System składa się z części przeznaczonej dla użytkownika oraz panelu administratora.
## Technologie
- PHP – logika aplikacji oraz komunikacja z bazą danych
- MySQL – przechowywanie danych
- HTML – struktura stron
- Apache – serwer WWW
- XAMPP – lokalne środowisko uruchomieniowe
- phpMyAdmin – zarządzanie bazą danych
## Funkcjonalności
### Użytkownik
- rejestracja konta,
- logowanie i wylogowanie,
- edycja profilu,
- zmiana danych użytkownika,
- tworzenie treningów,
- dodawanie ćwiczeń do treningów,
- zapisywanie wykonanych serii,
- zapisywanie wyników,
- przeglądanie własnych wyników,
- przeglądanie historii ćwiczeń,
- analiza historyczna wyników.
### Administrator
- dostęp do panelu administracyjnego,
- zarządzanie użytkownikami,
- przeglądanie listy użytkowników,
- edycja danych użytkowników,
- usuwanie użytkowników,
- zarządzanie ćwiczeniami,
- dodawanie nowych ćwiczeń,
- edycja istniejących ćwiczeń.
## Baza danych
Aplikacja korzysta z bazy danych MySQL.
W repozytorium znajduje się plik:
```text
fitplanner.sql
```
Plik zawiera strukturę bazy danych oraz przykładowe dane umożliwiające uruchomienie aplikacji i przetestowanie jej funkcjonalności.
Za połączenie aplikacji z bazą danych odpowiada plik:
```text
baza/laczenie_z_baza.php
```
Domyślna konfiguracja lokalnego środowiska XAMPP:
```text
Host: localhost
Użytkownik: root
Hasło: brak
Baza danych: fitplanner
```
## Wymagania
Do uruchomienia aplikacji potrzebne są:
- XAMPP
- Apache
- MySQL
- phpMyAdmin
- przeglądarka internetowa
## Instalacja i uruchomienie
### 1. Uruchomienie XAMPP
Uruchom XAMPP Control Panel, a następnie włącz:
Apache
MySQL
### 2. Umieszczenie projektu
Skopiuj folder `fitplanner` do katalogu:
```text
C:\xampp\htdocs\
```
Projekt powinien znajdować się w:
```text
C:\xampp\htdocs\fitplanner\
```
### 3. Utworzenie bazy danych
Otwórz phpMyAdmin:
```text
http://localhost/phpmyadmin/
```
Utwórz bazę danych o nazwie:
```text
fitplanner
```
### 4. Import bazy danych
W phpMyAdmin wybierz bazę danych `fitplanner`, a następnie przejdź do zakładki Import.
Wybierz znajdujący się w projekcie plik:
```text
fitplanner.sql
```
i rozpocznij import.
Po poprawnym imporcie baza danych powinna zawierać wszystkie wymagane tabele oraz przykładowe dane.
### 5. Konfiguracja połączenia z bazą danych
Aplikacja korzysta z domyślnej konfiguracji MySQL w XAMPP:
```text
Host: localhost
Użytkownik: root
Hasło: brak
Baza danych: fitplanner
```
Jeżeli konfiguracja MySQL w XAMPP jest inna, należy odpowiednio zmienić dane połączenia w pliku:
```text
baza/laczenie_z_baza.php
```
### 6. Uruchomienie aplikacji
Po uruchomieniu Apache i MySQL otwórz w przeglądarce:
```text
http://localhost/fitplanner/
```
## Przykładowe konta
W bazie danych znajdują się przykładowe, fikcyjne konta umożliwiające przetestowanie aplikacji.
Administrator
```text
Login: admin123
Hasło: admin333
```
Użytkownik
```text
Login: P_K123
Hasło: 123
```
Dane kont znajdujących się w bazie mają charakter wyłącznie demonstracyjny.
Struktura projektu
```text
fitplanner/
│
├── admin/                  # Panel administratora
├── baza/                   # Połączenie z bazą danych
├── funkcje/                # Wspólne funkcje aplikacji
├── logowanie/              # Logowanie i rejestracja
├── user/                   # Funkcjonalności użytkownika
├── fitplanner.sql          # Struktura i dane bazy danych
├── index.htm               # Strona główna
└──Opis aplikacji.pdf      # Dokumentacja projektu
```
## Dokumentacja
W repozytorium znajduje się plik `Opis aplikacji.pdf`, zawierający dodatkowe informacje dotyczące projektu.
## Bezpieczeństwo
Projekt został przygotowany jako aplikacja edukacyjna działająca w lokalnym środowisku XAMPP.
Dane użytkowników znajdujące się w przykładowej bazie danych są całkowicie fikcyjne.
Hasła użytkowników są przechowywane w bazie danych w postaci hashy.
## Autorzy
Projekt został wykonany w dwuosobowym zespole:
- Paweł Bagiński
- Mateusz Hurny
## Cel projektu
Celem projektu było stworzenie aplikacji webowej umożliwiającej użytkownikom planowanie i monitorowanie treningów oraz zarządzanie informacjami związanymi z wykonywanymi ćwiczeniami.
Projekt pozwolił również na praktyczne wykorzystanie technologii PHP, MySQL, HTML i CSS oraz zasad tworzenia aplikacji internetowych współpracujących z relacyjną bazą danych.

Aplikacja jest przeznaczona do uruchamiania lokalnie z wykorzystaniem środowiska XAMPP.
---
Projekt wykonany w celach edukacyjnych.
