### Datenbankstruktur
- **orders Tabelle**:
  - Speichert Bestelldetails (ID, customer_id, Bestellnummer, Status, Kosten)
  - Nutzt ENUM für order_status mit Werten: pending (ausstehend), processing (in Bearbeitung), completed (abgeschlossen), cancelled (storniert), paid (bezahlt), unpaid (unbezahlt)
  - Enthält Zeitstempel für Erstellung und Aktualisierung
  - Fremdschlüssel-Beziehung zur customers Tabelle

### Kernkomponenten

#### OrderController
Verarbeitet alle bestellungsbezogenen Operationen:
- **Index**: Listet alle Bestellungen mit Paginierung, Suche und Sortierfunktion
  - Suche nach Kundennamen, E-Mail, Status oder Betrag
  - Sortierung nach Kundennamen oder E-Mail
- **Show/View**: Zeigt detaillierte Bestellinformationen an:
  - Kundendaten (Name, E-Mail, Kontaktinformationen)
  - Produktliste mit Mengen und Preisen
  - Bestellzusammenfassung (Zwischensumme, Rabatte, Gesamtbetrag)
- **updateStatus**: Ermöglicht Statusänderungen mit Validierung

#### OrderModel
Bietet Datenbankoperationen:
- `getOrderWithCustomer()`: Ruft Bestellung mit zugehörigen Kundendaten ab
- `getOrderWithDetails()`: Holt alle Produkte einer Bestellung aus der order_line Tabelle
- Verarbeitet Datenbankinteraktionen mit korrekten Beziehungen

### Hauptfunktionen

1. **Bestellübersicht**
   - Anzeige aller Bestellungen in paginierter Tabelle
   - Visuelle Statusindikatoren mit farbigen Badges
   - Schnellzugriff auf Bestelldetails

2. **Detaillierte Bestellansichten**
   - Kundeninformationsbereich
   - Produktaufstellung mit Bildern
   - Finanzberechnungen (Zwischensumme, Rabatte, Versand, Gesamtbetrag)
   - Druckfunktion für Rechnungen

3. **Statusverwaltung**
   - Dynamische Statusaktualisierungen mit visueller Rückmeldung
   - Unterstützt den kompletten Bestelllebenszyklus:
     - Ausstehend → In Bearbeitung → Abgeschlossen/Storniert
     - Bezahlt/Unbezahlt Statusverfolgung

4. **Suche & Filterung**
   - Volltextsuche über Kunden- und Bestellfelder
   - Sortierbare Spalten zur einfachen Organisation

5. **Integrierte Kundeninformationen**
   - Verknüpft Bestellungen mit Kundenprofilen
   - Zeigt Kundendaten und Historie an
   - Zeigt Kundenavatare an, sofern verfügbar

### Views
- **index.php**: Hauptbestellliste mit Such-/Sortierfunktionen
- **show.php**: Detaillierte Bestellansicht mit Statusverwaltung
- **view.php**: Vereinfachte Bestellansicht

### Hilfsfunktionen
- `getOrderStatusBadge()`: Erzeugt formatierte Statusindikatoren
- Währungsformatierung für einheitliche Preisangaben
- Datumsformatierungsfunktionen

### Geschäftslogik
- Automatische Rabattberechnung (10% für Bestellungen ≥ €100)
- Kostenloser Versand
- Statusänderungsvalidierung

Das System ist integriert mit:
- Kundenverwaltungsmodul
- Produktkatalog
- Authentifizierungssystem