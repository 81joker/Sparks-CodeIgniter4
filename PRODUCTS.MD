
## 🧩 Features

- Zentrale Methode zur Verwaltung von:
  - `per_page`: Anzahl der Einträge pro Seite
  - `search`: Freitextsuche mit Trimmen und Whitespace-Reduktion
  - `sort_field`: Sortierfeld
  - `sort_direction`: Sortierrichtung (`ASC` / `DESC`)
- DRY-Prinzip durch zentrale `getListParams()` Methode im `BaseController`
- Bootstrap-kompatible Views (optional)

## 🔧 Aufbau der Logik

Die Methode `getListParams()` befindet sich im `BaseController` und verarbeitet automatisch die üblichen Query-Parameter:

```php
protected function getListParams(): array
{
    $request = service('request');

    $perPage = $request->getGet('per_page') ?? 10;
    $search = trim(preg_replace('/\s+/', ' ', $request->getGet('search') ?? ''));
    $sortField = $request->getGet('sort_field') ?? 'updated_at';
    $sortDirection = strtoupper($request->getGet('sort_direction') ?? 'DESC');

    $sortDirection = in_array($sortDirection, ['ASC', 'DESC']) ? $sortDirection : 'DESC';

    return compact('perPage', 'search', 'sortField', 'sortDirection');
}
