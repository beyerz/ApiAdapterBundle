<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 12/09/2017
 * Time: 13:44
 */

namespace Beyerz\ApiClientBundle\Adapter;


interface AdapterInterface
{

    public function getResponse();

    public function setResponse($response);

    public function deserialize($class);

    public function serialize($input);
}