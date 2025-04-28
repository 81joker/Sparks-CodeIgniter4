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




# Datenbank-Schema Dokumentation
Siehe [DATABASE.md](DATABASE.md) für detaillierte Schema-Dokumentation.


# User- und Benutzerdatenverwaltung
Sehe [USERS.md](USERS.md) für detaillierte Informationen zur User- und Benutzerdatenverwaltung.


# Productverwaltun
Sehe [PRODUCTS.md](PRODUCTS.md) für detaillierte Informationen zur Produktverwaltung.

# Orderverwaltung
Sehe [ORDERS.md](ORDERS.md) für detaillierte Informationen zur Orderverwaltung.


# Dashboard
Sehe [DAHBAORD.md](DAHBAORD.md) für detaillierte Informationen zum Dashboard.