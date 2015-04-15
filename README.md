Ligneus\ExceptionTrackerBundle
==============================

Übermittelt die Fehlerinfo an den Exception Server im Fehlerfall

## Installation

### Parameter

In der Datei `app/config/parameters.yml.dist` müssen folgende Parameter eingetragen werden (Beispielwerte!):

```yml
#exception tracker
ligneus.exception.tracker_endpoint: {serverUrl}
ligneus.exception.app_key: {appKey}
```

### Bundle registrierung

Das Bundle muss in der Datei `app/AppKernel.php` registriert werden

```php
public function registerBundles()
{
    $bundles = array(
        // ...
        new Ligneus\ExceptionTrackerBundle\LigneusExceptionTrackerBundle(),
    );
}
```

### Composer

Um das Bundle laden zu können muss die Datei `composer.json` wie folgt angepasst werden:

```json
"repositories": [
    {
        "type": "composer",
        "url": "http://erpag:erpag2013@toran.erpag.info/repo/private/"
    }
],

"require": {
    "ligneus/exception-tracker-bundle": "1.*"
}
```