<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
      $repository = $this
        ->getDoctrine()
        ->getRepository('BlogBundle:Post');

      $posts = $repository->paginate(5, 0);

        return $this->render('BlogBundle:Default:index.html.twig', ['posts' => $posts]);
    }
}
