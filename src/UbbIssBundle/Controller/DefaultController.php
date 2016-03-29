<?php

namespace UbbIssBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $authenticatedUser= $this->get('security.context')->getToken()->getUser();
        return $this->render('UbbIssBundle:Default:index.html.twig',
            array(
                'username' => $authenticatedUser->getUsername()
        ));
    }
}
