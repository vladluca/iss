<?php

namespace UbbIssBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('UbbIssBundle:Default:index.html.twig');
    }
}
