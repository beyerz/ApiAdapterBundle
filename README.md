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
Select the correct adapter

Create your own gateway class that extends the correct base gateway

Potentially create a manager (facade) that your system can interact with the api

Create the response entities and use JMSSerializer to define the deserializer configs

#TODO
#Add a sample of how it works