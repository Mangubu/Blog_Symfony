<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SessionController extends Controller
{
    public function newAction(Request $request)
    {
      $authenticationUtils = $this->get('security.authentication_utils');

// get the login error if there is one
$error = $authenticationUtils->getLastAuthenticationError();

// last username entered by the user
$lastUsername = $authenticationUtils->getLastUsername();

return $this->render(
    'BlogBundle:Session:new.html.twig',
    array(
        // last username entered by the user
        'last_username' => $lastUsername,
        'error'         => $error,
    )
);
      //return $this->render('BlogBundle:Session:new.html.twig');
    }

    public function createAction(Request $request)
    {
    }
}
