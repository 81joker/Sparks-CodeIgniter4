
## Projektübersicht

- CRUD-Operationen für Benutzer
- Rollenbasierte Zugriffskontrolle (Admin/Instructor)
- Personen- und Benutzerdatenverwaltung
- Dateiupload für Benutzeravatare
- Paginierung und Suchfunktionalität

## Datenbankschema

Siehe [DATABASE.md](DATABASE.md) für detaillierte Schema-Dokumentation.

## Funktionsweise

### Kernkomponenten

1. **BaseController**
   - Zentrale Basisklasse für alle Controller
   - Implementiert gemeinsame Funktionen:
     - `getListParams()`: Verarbeitet Paginierungs-, Sortier- und Suchparameter
     - Initialisiert gemeinsame Abhängigkeiten

2. **UserController**
   - Hauptcontroller für Benutzerverwaltung
   - Methoden:
     - `index()`: Listet Benutzer mit Paginierung und Suche
     - `create()/store()`: Erstellt neue Benutzer
     - `edit()/update()`: Aktualisiert Benutzerdaten
     - `show()`: Zeigt Benutzerdetails
     - `delete()`: Löscht Benutzer



3. **Helper-Klassen**
   - `FileUploadService`: Handhabt Dateiuploads und -aktualisierungen
   - `ValidationHelper`: Zentrale Validierungsregeln für verschiedene Kontexte


## Benutzerliste (index()-Methode)

### Funktion
Zeigt eine paginierte Liste aller Benutzer mit Such-, Sortier- und Filterfunktionen.

### Arbeitsweise

1. **Parameterabruf**:
   - Holt Paginierungs-, Such- und Sortierparameter via `getListParams()`
   - Standardwerte: 10 Einträge pro Seite, sortiert nach `updated_at` absteigend

2. **Datenbankabfrage**:
   ```   
   $query = $this->userModel->select('users.id AS user_id, users.*, persons.*')
       ->join('persons', 'users.person_id = persons.id', 'left')
       ->orderBy('users.id', 'DESC');
   ```
       

3. **Search Function**

Searches through first name, last name, email, and combined names.

```php
->groupStart()
    ->like('firstname', $search)
    ->orLike('lastname', $search)
    ->orLike('email', $search)
->groupEnd()
```

4. **Sorting**
In dieser Anwendung haben wir eine spezielle Handhabung für die Sortierung von Datensätzen. Die Sortierung kann nach zwei Kriterien erfolgen:

- **Name** (Nachname + Vorname)
- **Email** (Email-Adresse)

Die Sortierung wird durch die folgenden Bedingungen in unserem Code realisiert:

```php
if ($sortField === 'name') {
    $query->orderBy('persons.lastname', $sortDirection)
          ->orderBy('persons.firstname', $sortDirection);
} elseif ($sortField === 'email') {
    $query->orderBy('persons.email', $sortDirection);
}
```

5. **Pagination**
Die Anwendung verwendet eine Pagination, um die Benutzerliste auf mehrere Seiten zu teilen. Die Pagination wird durch die folgenden Bedingungen in unserem Code realisiert:   

```php
$users = $query->paginate($perPage, 'users');
```

6. **View**
Die Benutzerliste wird im View `users/index.php` dargestellt. Die View enthaltet die Benutzerliste, die Pagination und die Such- und Sortierfunktionen.
   





