<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 12/09/2017
 * Time: 13:56
 */

namespace Beyerz\ApiClientBundle\Adapter;


class XMLAdapter extends Adapter
{

    /**
     * @param $class
     * @return array|\JMS\Serializer\scalar|mixed|object
     */
    public function deserialize($class)
    {
        $serializer = $this->container->get('jms_serializer');

        return $serializer->deserialize($this->getResponse(), $class, 'xml');
    }

    public function serialize($input)
    {
        $serializer = $this->container->get('jms_serializer');

        return $serializer->serialize($input, 'xml');
    }
}