<?php
/**
 * Created by PhpStorm.
 * User: bailz777
 * Date: 13/09/2017
 * Time: 14:02
 */

namespace Beyerz\ApiClientBundle\Adapter;


class SoapAdapter extends Adapter
{

    /**
     * @param $class
     *
     * @return mixed
     */
    public function deserialize($class)
    {
        return $class::__set_state($this->getResponse());
    }

    /**
     * @param $input
     *
     * @return mixed
     */
    public function serialize($input)
    {
        // TODO: Implement serialize() method.
    }
}