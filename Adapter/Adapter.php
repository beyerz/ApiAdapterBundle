<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 12/09/2017
 * Time: 13:44
 */

namespace Beyerz\ApiClientBundle\Adapter;

use Symfony\Component\DependencyInjection\ContainerAwareTrait;

abstract class Adapter implements AdapterInterface
{
    use ContainerAwareTrait;

    /**
     * @var
     */
    protected $response;


    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param $response
     *
     * @return $this
     */
    public function setResponse($response)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * @param $class
     *
     * @return mixed
     */
    abstract public function deserialize($class);

    /**
     * @param $input
     *
     * @return mixed
     */
    abstract public function serialize($input);
}