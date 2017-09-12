<?php

namespace Beyerz\ApiClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BeyerzApiClientBundle:Default:index.html.twig');
    }
}
