<?php

namespace BlogBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\HttpKernel;

class VerbListener
{
    public function onKernelRequest ( GetResponseEvent $event )
    {
        $request = $event->getRequest();

        if ( HttpKernel::MASTER_REQUEST === $event->getRequestType()
                && $request->getMethod() === 'GET' )
        {
          switch ($request->query->get('_method')) {
            case 'DELETE':
              $request->setMethod( 'DELETE' );
              break;
            case 'PUT':
              $request->setMethod( 'PUT' );
              break;
          }
        }
    }
}
