# Produktverwaltungssystem

## Übersicht
Ein Produktverwaltungssystem auf Basis von CodeIgniter 4 mit vollständiger CRUD-Funktionalität, Bildverwaltung und Funktionen zur Produktverknüpfung.

## Funktionen
- **Produktverwaltung**
  - Erstellen, Anzeigen, Bearbeiten und Löschen von Produkten
  - Hochladen und Verwalten von Produktbildern
  - Verwaltung des Produktstatus (aktiv/inaktiv)

- **Erweiterte Funktionen**
  - Seitlich paginierte Produktauflistungen
  - Such- und Sortierfunktionen
  - System für verwandte Produkte
  - Validierung und Fehlerbehandlung

## 1- **Produkt-Controller**

- Paginierte Anzeige
- Suchfunktion nach Name/Preis/Status
- Sortierung nach verschiedenen Kriterien
- Produktdetails (`show()`): Zeigt detaillierte Produktinformationen an
- Empfiehlt verwandte Produkte basierend auf der Bestellhistorie

**CRUD-Operationen**
- `create()/store()`: Neues Produkt erstellen
- `edit()/update()`: Bestehendes Produkt bearbeiten
- `delete()`: Produkt löschen (inklusive Bildlöschung)

## 2- **ProductModel**

## 3- **Frontend-Views**

A. **Produktliste (products/index)**  
   - Tabellarische Darstellung  
   - Such- und Sortierfunktionen  
   - Paginierungssteuerung  
   - Responsives Design  
B- **Produktformular(create/edit)**  

C- **Produktdetails(show)**  
   - Produktinformationen anzeigen  
   - Verwandte Produkte anzeigenen  

## Beziehungen

- Viele-zu-viele mit `order_line` (Verbindungstabelle zwischen Bestellungen und Produkten)