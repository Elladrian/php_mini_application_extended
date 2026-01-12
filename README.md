# MiniApp - System Ofert i Kontaktów
Aplikacja webowa oparta na frameworku Laravel 12. Umożliwia przeglądanie ofert, kontakt z firmą oraz zarządzanie treścią poprzez panel administracyjny (wymaga logowania).

## 📋 Wymagania serwera
Aby uruchomić aplikację, serwer musi spełniać następujące wymagania:
- PHP: Wersja 8.2 lub nowsza.
- Rozszerzenia PHP: BCMath, Ctype, Fileinfo, JSON, Mbstring, OpenSSL, PDO, Tokenizer, XML.
- Baza danych: SQLite (domyślnie włączona) LUB MySQL/MariaDB.
- Serwer WWW: Apache (z mod_rewrite) lub Nginx.

## 🚀 SCENARIUSZ A: Serwer Dedykowany / VPS / Localhost
(Dla środowisk, gdzie masz dostęp do terminala/konsoli i możesz instalować oprogramowanie)

### 1. Pobranie plików
   Sklonuj repozytorium lub wypakuj pliki aplikacji do folderu docelowego (np. `/var/www/miniapp`).

### 2. Instalacja bibliotek zależnych (Composer & NPM)
   Aplikacja korzysta z zewnętrznych bibliotek (m.in. PHPMailer, Laravel Breeze). Należy je pobrać menedżerem pakietów.

W folderze projektu uruchom:

Bash

```bash
# Instalacja zależności backendu (PHP)
composer install --optimize-autoloader --no-dev

# Instalacja zależności frontendu i budowanie plików CSS/JS
npm install
npm run build
```

### 3. Konfiguracja środowiska (.env)
   Skopiuj przykładowy plik konfiguracyjny i dostosuj go:

```bash
cp .env.example .env
```

Otwórz plik `.env` w edytorze i ustaw:

`APP_URL`: Adres Twojej strony (np. `http://twoja-domena.pl`).

Baza danych:

Jeśli używasz **SQLite** (domyślnie): Upewnij się, że `DB_CONNECTION=sqlite`.

Jeśli używasz **MySQL**: Zmień na `DB_CONNECTION=mysql` i uzupełnij `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.

### 4. Finalizacja instalacji
Uruchom następujące komendy, aby wygenerować klucz szyfrowania i przygotować bazę danych:

```Bash
# Generowanie klucza aplikacji
php artisan key:generate

# Utworzenie tabel w bazie danych (Migracja)
php artisan migrate --force

# (Opcjonalnie) Wypełnienie bazy przykładowymi danymi
php artisan db:seed
```

### 5. Uruchomienie
Skonfiguruj serwer Nginx/Apache tak, aby wskazywał na folder `/public` aplikacji.

Uprawnienia: Upewnij się, że foldery `storage` oraz `bootstrap/cache` mają prawa do zapisu (np. chmod -R 775 storage).

## ☁️ SCENARIUSZ B: Hosting Współdzielony (Shared Hosting)
(Dla środowisk bez dostępu do terminala SSH, obsługiwanych tylko przez FTP/cPanel)

Ponieważ na hostingu nie możesz uruchomić composer install, musisz przygotować "paczkę instalacyjną" na swoim komputerze.

### Krok 1: Przygotowanie plików lokalnie
Na swoim komputerze:
1. Uruchom instalację bibliotek w trybie produkcyjnym (to pobierze vendor ze wszystkimi zależnościami jak PHPMailer):
```Bash
composer install --optimize-autoloader --no-dev
```
2. Skompiluj style CSS i JavaScript:

```bash
npm run build
```
3. Usuń folder `node_modules` (nie jest potrzebny na serwerze).
4. Spakuj wszystkie pliki projektu do archiwum `.zip` (łącznie z ukrytym plikiem `.env.example`, folderem `vendor` i `public`).

### Krok 2: Wgranie na serwer (FTP)
1. Zaloguj się na swój hosting przez FTP.
2. Wgraj pliki aplikacji.
   - **Ważne**: Ze względów bezpieczeństwa, pliki aplikacji (katalogi app, config, vendor, .env itp.) powinny znajdować się powyżej folderu publicznego (public_html). 
   - Zawartość folderu public z Twojej aplikacji przenieś do folderu public_html na serwerze.

### Krok 3: Edycja ścieżek (index.php)
Jeśli rozdzieliłeś pliki (kod poza `public_html`), musisz edytować plik `public_html/index.php` na serwerze.

Znajdź linie ładujące `autoload.php` i `app.php` i popraw ścieżki, np.:

```php
require __DIR__.'/../miniapp/vendor/autoload.php';
$app = require __DIR__.'/../miniapp/bootstrap/app.php';
```

### Krok 4: Konfiguracja Bazy Danych i .env
Na serwerze zmień nazwę pliku `.env.example` na `.env`.

Jeśli używasz **SQLite**:
- Wgraj plik **database/database.sqlite** na serwer.
- W `.env` podaj pełną ścieżkę absolutną do pliku, np.: `DB_DATABASE=/home/user/miniapp/database/database.sqlite`.
Jeśli używasz MySQL (zalecane na hostingu):
- Utwórz bazę w panelu hostingu (np. DirectAdmin/cPanel).
- Zaimportuj strukturę tabel (wyeksportuj ją lokalnie z phpMyAdmin lub MySQL Workbench i zaimportuj na hostingu).
- Uzupełnij dane w `.env`.

## 📧 Obsługa Poczty (PHPMailer)
Aplikacja wykorzystuje bibliotekę `PHPMailer` instalowaną przez Composer. Aby wysyłanie e-maili działało na produkcji, należy skonfigurować serwer SMTP w pliku `.env`:
```plain text
MAIL_MAILER=smtp
MAIL_HOST=smtp.twoj-hosting.pl
MAIL_PORT=587
MAIL_USERNAME=twoj@email.pl
MAIL_PASSWORD=twoje-haslo
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="twoj@email.pl"
MAIL_FROM_NAME="MiniApp"
```

## 🛠 Rozwiązywanie problemów
1. Błąd 500 (Server Error):
   - Sprawdź uprawnienia do folderu `storage`. Muszą być ustawione na `775` lub `777`. 
   - Sprawdź logi w `storage/logs/laravel.log`.
2. Brak stylów CSS (strona jest biała/brzydka):
   - Upewnij się, że wykonałeś `npm run build` przed wysłaniem plików.
   - Sprawdź, czy w folderze `public/build/assets` znajdują się pliki `.css` i `.js`.
3. Błąd "View [offer] not found":
   - Wyczyść pamięć podręczną widoków. Jeśli masz terminal: `php artisan view:clear`. Jeśli nie, usuń ręcznie pliki z folderu `storage/framework/views`.
