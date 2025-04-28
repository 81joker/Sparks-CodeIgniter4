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



