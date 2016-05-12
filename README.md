Phylax\PhylaxTrackerBundle
==============================

Sends Error/Exception Information to a Phylax Server

## Installation

### Parameters

You have to provide following parameters in the file `app/config/parameters.yml.dist`:

```yml
#phylax tracker
phylax.exception.tracker_endpoint: {serverUrl}
phylax.exception.app_key: {appKey}
```

### Register Bundle

Register the Bundle in the file `app/AppKernel.php`

```php
public function registerBundles()
{
    $bundles = array(
        // ...
        new Phylax\PhylaxTrackerBundle\PhylaxPhylaxTrackerBundle(),
    );
}
```

### Composer

    composer require phylax/phylax-tracker-bundle
