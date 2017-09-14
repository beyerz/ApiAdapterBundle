<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 12/09/2017
 * Time: 15:52
 */

namespace Beyerz\ApiAdapterBundle\Gateway;


use BeSimple\SoapClient\SoapClient;
use Beyerz\ApiClientBundle\Adapter\AdapterInterface;
use Symfony\Bridge\Monolog\Logger;

class SoapGateway extends Gateway
{

    /**
     * SoapGateway constructor.
     *
     * @param SoapClient       $client
     * @param AdapterInterface $adapter
     * @param Logger           $logger
     */
    public function __construct(SoapClient $client, AdapterInterface $adapter, Logger $logger)
    {
        $this->client = $client;
        $this->adapter = $adapter;
        $this->logger = $logger;
    }

    /**
     * @param string $method     SOAP Method/Action name
     * @param array  $parameters Parameters required by the soap method
     * @param null   $class
     *
     * @return array|\JMS\Serializer\scalar|mixed|object
     */
    public function request($method, $parameters = [], $class = null)
    {
        $response = $this->client->__soapCall($method, $parameters);

        if (!is_null($class)) {
            return $this->adaptResponse($response, $class);
        }

        return $response;
    }
}