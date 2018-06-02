# Api Client Bundle
## About
Api Client Bundle for Symfony2

This bundle provides a gateway and adapter pattern for connecting to thrid party apis.

Using JMSSerializer, you will simply need to provide the data class to be populated with the api response.

# Installation

### Composer (Recommended)

    composer require beyerz/api-adapter-bundle

### Application Kernel

Add BeyerzApiAdapterBundle to the `registerBundles()` method of your application kernel:
Due to the way that this bundle is compiled and the fact that other bundles could require it, please ensure that the bundle is the last parameter in the array.
```php
public function registerBundles()
{
    return array(
        new Beyerz\ApiAdapterBundle\BeyerzApiAdapterBundle(),
    );
}
```

# Usage
## Config
config.yml
```yaml
beyerz_api_adapter:
  json:
    my_client: #name of your client to be used, this will be accessable through container as beyerz_api_adapter.client.YOUR_CUSTOM_NAME
      base_url: "first_base_url"
      options:
        - "an option"
        - "another option"
```

## Files and their purpose

###Manager
In the manager you would write any business logic that is related to api, but not directly connected to the api.
For example, if you wanted to save a copy of every response that the api returns, you could do this here.

The manager is essentially the only class that your system should work against in order to interact with the api.

The manager should have the gateway in the constructor

###Adapter
The adapters job is to translate the api response into a php class. You select the adapter based on your api response type.
For rest apis it is most common to use the JsonAdapter.

###Gateway
We provide base gateway classes, but it is suggested that you extend from one of our base classes
and add the api functions that you intend on using.

###Response Entity
A response entity, is a data class that used JMSSeriliazer definitions to translate the API response.
This is the class that will be passed to the gateway request from the manager.

In the event that a class is not passed, the plain Response will be returned to the manager.
Sometimes this is useful when building out the api.

#TODO
#Add a sample of how it works
