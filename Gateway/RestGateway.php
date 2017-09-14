<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 12/09/2017
 * Time: 15:49
 */

namespace Beyerz\ApiAdapterBundle\Gateway;


use Beyerz\ApiClientBundle\Adapter\AdapterInterface;
use GuzzleHttp\Client;
use Symfony\Bridge\Monolog\Logger;

class RestGateway extends Gateway
{

    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PATCH = 'PATCH';
    const METHOD_DELETE = 'DELETE';

    /**
     * Gateway constructor.
     *
     * @param Client           $client
     * @param AdapterInterface $adapter
     * @param Logger           $logger
     */
    public function __construct(Client $client, AdapterInterface $adapter, Logger $logger)
    {
        $this->client = $client;
        $this->adapter = $adapter;
        $this->logger = $logger;
    }

    /**
     * @param string $method HTTP Method
     * @param null   $uri
     * @param array  $options
     * @param null   $class
     *
     * @return array|\JMS\Serializer\scalar|mixed|object|\Psr\Http\Message\ResponseInterface
     */
    private function request($method, $uri = null, array $options = [], $class = null)
    {
        $response = $this->client->request($method, $uri, $options);
        if (!is_null($class)) {
            return $this->adaptResponse($response, $class);
        }

        return $response;
    }

    /**
     * @param string $uri
     * @param array  $options
     * @param null   $class
     *
     * @return array|\JMS\Serializer\scalar|mixed|object|\Psr\Http\Message\ResponseInterface
     */
    protected function get($uri, array $options = [], $class = null)
    {
        return $this->request(self::METHOD_GET, $uri, $options, $class);
    }

    /**
     * @param string $uri
     * @param array  $options
     * @param null   $class
     *
     * @return array|\JMS\Serializer\scalar|mixed|object|\Psr\Http\Message\ResponseInterface
     */
    protected function post($uri, array $options = [], $class = null)
    {
        return $this->request(self::METHOD_POST, $uri, $options, $class);
    }

    /**
     * @param string $uri
     * @param array  $options
     * @param null   $class
     *
     * @return array|\JMS\Serializer\scalar|mixed|object|\Psr\Http\Message\ResponseInterface
     */
    protected function patch($uri, array $options = [], $class = null)
    {
        return $this->request(self::METHOD_PATCH, $uri, $options, $class);
    }

    /**
     * @param string $uri
     * @param array  $options
     * @param null   $class
     *
     * @return array|\JMS\Serializer\scalar|mixed|object|\Psr\Http\Message\ResponseInterface
     */
    protected function delete($uri, array $options = [], $class = null)
    {
        return $this->request(self::METHOD_DELETE, $uri, $options, $class);
    }
}