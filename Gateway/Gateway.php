<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 12/09/2017
 * Time: 15:30
 */

namespace Beyerz\ApiAdapterBundle\Gateway;


use Beyerz\ApiClientBundle\Adapter\AdapterInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Symfony\Bridge\Monolog\Logger;

class Gateway
{

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @param $response
     * @param          $class
     *
     * @return array|\JMS\Serializer\scalar|mixed|object
     */
    protected function adaptResponse($response, $class)
    {
        $this->adapter->setResponse($response);

        return $this->adapter->deserialize($class);
    }

}