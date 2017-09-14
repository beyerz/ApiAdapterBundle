<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 12/09/2017
 * Time: 13:55
 */

namespace Beyerz\ApiAdapterBundle\Adapter;


class JsonAdapter extends Adapter
{

    /**
     * @param $class
     * @return mixed
     */
    public function deserialize($class)
    {
        $serializer = $this->container->get('jms_serializer');

        return $serializer->deserialize($this->getResponse()->getBody(), $class, 'json');
    }

    /**
     * @param $input
     * @return mixed
     */
    public function serialize($input)
    {
        $serializer = $this->container->get('jms_serializer');

        return $serializer->serialize($input, 'json');
    }
}