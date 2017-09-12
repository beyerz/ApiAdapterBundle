# Api Client Bundle
## About
Api Client Bundle for Symfony2

This bundle provides a gateway and adapter pattern for connecting to thrid party apis.

Using JMSSerializer, you will simply need to provide the data class to be populated with the api response.

# Installation

### Composer (Recommended)

    composer require beyerz/api-client-bundle

### Application Kernel

Add ApiClientBundle to the `registerBundles()` method of your application kernel:

```php
public function registerBundles()
{
    return array(
        new Beyerz\ApiClientBundle\BeyerzApiClientBundle(),
    );
}
```

# Usage
