## Übersicht

Dieses Projekt läuft in einer Docker-Umgebung. Das Setup umfasst:

- **PHP 8.2** für die Ausführung des CodeIgniter-Frameworks.
- **MySQL 8** als Datenbankserver.
- **phpMyAdmin**, um die MySQL-Datenbank einfach über eine Weboberfläche zu verwalten.

Docker wird verwendet, um all diese Dienste zu orchestrieren, was die Einrichtung und Ausführung des Projekts lokal vereinfacht.

## Hauptmerkmale

- **Docker-Integration**: Vereinfacht die Einrichtung der Entwicklungsumgebung mit Docker.
- **Datenbank-Interaktion**: Unterstützt MySQL-Datenbanken mit einem Testskript zur Fehlerbehebung bei Verbindungen.

## Installationsanweisungen

1. **Abhängigkeiten installieren**
   ```bash
   cd app
   composer update
   ```
   ```bash
   cd app
   cp env .env
   ```

2. **Docker-Container starten**
   ```bash
   docker-compose up --build -d
   ```

3. **Anwendung-Container betreten**
   ```bash
   docker exec -it app bash
   ```

4. **Migrationen ausführen**
   ```bash
   php spark migrate
   ```

5. **Seeders ausführen**
   ```bash
   php spark db:seed TestSeed
   ```
## Troubleshooting Database Connections

If you encounter MySQL connection issues, you can use the database test file located at `public/test_db.php` to verify your connection.

This test file attempts to connect using the following environment variables (or defaults if not set):
- Hostname: `database.default.hostname` (default: 'db')
- Username: `database.default.username` (default: 'ci4_user')
- Password: `database.default.password` (default: 'ci4_password')
- Database: `database.default.database` (default: 'ci4')

## Übersicht

Dieses Projekt läuft in einer Docker-Umgebung. Das Setup umfasst:

- **PHP 8.2** für die Ausführung des CodeIgniter-Frameworks.
- **MySQL 8** als Datenbankserver.
- **phpMyAdmin**, um die MySQL-Datenbank einfach über eine Weboberfläche zu verwalten.

Docker wird verwendet, um all diese Dienste zu orchestrieren, was die Einrichtung und Ausführung des Projekts lokal vereinfacht.

## Hauptmerkmale

- **Docker-Integration**: Vereinfacht die Einrichtung der Entwicklungsumgebung mit Docker.
- **Datenbank-Interaktion**: Unterstützt MySQL-Datenbanken mit einem Testskript zur Fehlerbehebung bei Verbindungen.

## Installationsanweisungen

1. **Abhängigkeiten installieren**
   ```bash
   cd app
   composer update
   ```
   ```bash
   cd app
   cp env .env
   ```

2. **Docker-Container starten**
   ```bash
   docker-compose up --build -d
   ```

3. **Anwendung-Container betreten**
   ```bash
   docker exec -it app bash
   ```

4. **Migrationen ausführen**
   ```bash
   php spark migrate
   ```

5. **Seeders ausführen**
   ```bash
   php spark db:seed TestSeed
   ```

## Datenbankschema und Beziehungen

Die Anwendung verwendet eine MySQL-Datenbank. Nachfolgend sind die wichtigsten Tabellen und ihre Beziehungen aufgeführt:

- **Benutzer**
  - Spalten: `id`, `username`, `email`, `password`, `created_at`, `updated_at`
  - Beziehungen: Eins-zu-Viele mit `Posts`

- **Posts**
  - Spalten: `id`, `user_id` (FK), `title`, `content`, `created_at`, `updated_at`
  - Beziehungen: Viele-zu-Eins mit `Benutzer`, Eins-zu-Viele mit `Kommentare`

- **Kommentare**
  - Spalten: `id`, `post_id` (FK), `user_id` (FK), `comment`, `created_at`, `updated_at`
  - Beziehungen: Viele-zu-Eins mit `Posts` und `Benutzer`

Jede Tabelle ist normalisiert, um die Datenintegrität zu gewährleisten und Redundanzen zu minimieren.

## Fehlerbehebung bei Datenbankverbindungen

Falls Probleme auftreten, verwenden Sie die Testdatei für die Datenbank (`public/test_db.php`) mit den folgenden Umgebungsvariablen:

- Hostname: `database.default.hostname` (Standard: 'db')
- Benutzername: `database.default.username` (Standard: 'ci4_user')
- Passwort: `database.default.password` (Standard: 'ci4_password')
- Datenbank: `database.default.database` (Standard: 'ci4')

Das Testskript zeigt Verbindungsstatus und Debugging-Details an.

## Tests

### Anforderungen

- Neueste PHPUnit-Version (9.x empfohlen)
- XDebug für die Codeabdeckung

### Tests ausführen

```bash
./phpunit
```

### Codeabdeckung generieren

```bash
./phpunit --coverage-html=tests/coverage/
```

## Serveranforderungen

- **PHP-Version**: 8.1 oder höher
- **Erweiterungen**:
  - `intl`
  - `mbstring`
  - `json` (standardmäßig aktiviert)
  - `mysqlnd` (für MySQL)
  - `libcurl` (für HTTP-Anfragen)

## Lizenz

Dieses Projekt ist unter der MIT-Lizenz lizenziert. Weitere Informationen finden Sie in der LICENSE-Datei.


# Datenbank-Schema Dokumentation

## Tabellen

### 1. `persons` Tabelle
Speichert grundlegende persönliche Informationen, die von anderen Tabellen referenziert werden können.

**Felder:**
- `id` (INT, PK): Automatisch inkrementierender Primärschlüssel
- `firstname` (VARCHAR): Vorname der Person
- `lastname` (VARCHAR): Nachname der Person
- `email` (VARCHAR, unique): E-Mail-Adresse der Person
- `phone` (VARCHAR, nullable): Telefonnummer der Person
- `created_at` (TIMESTAMP): Zeitstempel der Erstellung
- `updated_at` (TIMESTAMP): Zeitstempel der Aktualisierung

### 2. `users` Tabelle
Speichert Benutzerkonten für den Systemzugang (Administratoren und Instruktoren).

**Felder:**
- `id` (INT, PK): Automatisch inkrementierender Primärschlüssel
- `person_id` (INT, FK, unique): Verweis auf `persons.id` (Eins-zu-eins)
- `password` (VARCHAR): Gehashtes Passwort
- `role` (ENUM): Benutzerrolle ('admin' oder 'instructor')
- `avatar` (VARCHAR, nullable): Pfad zum Profilbild
- `status` (VARCHAR): Kontostatus (Standard 'active')
- `created_at` (TIMESTAMP): Zeitstempel der Erstellung
- `updated_at` (TIMESTAMP): Zeitstempel der Aktualisierung

**Beziehungen:**
- Eins-zu-eins mit `persons` über `person_id`

### 3. `customers` Tabelle
Speichert Kundeninformationen, die Eltern oder Kinder sein können.

**Felder:**
- `id` (INT, PK): Automatisch inkrementierender Primärschlüssel
- `person_id` (INT, FK, unique): Verweis auf `persons.id` (Eins-zu-eins)
- `parent_id` (INT, FK, nullable): Verweis auf `customers.id` für Eltern-Kind-Beziehungen
- `type` (ENUM): Kundentyp ('parent' oder 'child')
- `avatar` (VARCHAR, nullable): Pfad zum Profilbild
- `status` (VARCHAR): Kontostatus (Standard 'active')
- `password` (VARCHAR): Gehashtes Passwort
- `created_at` (TIMESTAMP): Zeitstempel der Erstellung
- `updated_at` (TIMESTAMP): Zeitstempel der Aktualisierung

**Beziehungen:**
- Eins-zu-eins mit `persons` über `person_id`
- Selbstreferenzierende Beziehung über `parent_id` (ein Kind-Kunde kann einen Eltern-Kunde haben)

### 4. `products` Tabelle
Speichert Produktinformationen.

**Felder:**
- `id` (INT, PK): Automatisch inkrementierender Primärschlüssel
- `name` (VARCHAR): Produktname
- `description` (TEXT, nullable): Produktbeschreibung
- `price` (DECIMAL): Produktpreis
- `image` (VARCHAR, nullable): Pfad zum Produktbild
- `stock` (INT): Aktueller Lagerbestand
- `status` (VARCHAR): Produktstatus (Standard 'active')
- `created_at` (TIMESTAMP): Zeitstempel der Erstellung
- `updated_at` (TIMESTAMP): Zeitstempel der Aktualisierung

### 5. `orders` Tabelle
Speichert Bestellinformationen.

**Felder:**
- `id` (INT, PK): Automatisch inkrementierender Primärschlüssel
- `customer_id` (INT, FK): Verweis auf `customers.id`
- `image` (VARCHAR, nullable): Bestellbild/-dokument
- `order_number` (VARCHAR, unique): Eindeutige Bestellnummer
- `cost` (DECIMAL): Bestellkosten
- `total_amount` (DECIMAL): Gesamtbetrag der Bestellung
- `order_status` (ENUM): Aktueller Bestellstatus
- `created_at` (TIMESTAMP): Zeitstempel der Erstellung
- `updated_at` (TIMESTAMP): Zeitstempel der Aktualisierung

**Beziehungen:**
- Viele-zu-eins mit `customers` über `customer_id` (ein Kunde kann viele Bestellungen haben)

### 6. `order_line` Tabelle
Speichert Bestellpositionen (Verbindungstabelle zwischen Bestellungen und Produkten).

**Felder:**
- `id` (INT, PK): Automatisch inkrementierender Primärschlüssel
- `product_id` (INT, FK): Verweis auf `products.id`
- `order_id` (INT, FK): Verweis auf `orders.id`
- `quantity` (INT): Menge des bestellten Produkts
- `created_at` (TIMESTAMP): Zeitstempel der Erstellung
- `updated_at` (TIMESTAMP): Zeitstempel der Aktualisierung

**Beziehungen:**
- Viele-zu-eins mit `products` über `product_id`
- Viele-zu-eins mit `orders` über `order_id`



