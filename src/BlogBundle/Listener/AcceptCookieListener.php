<?php

namespace BlogBundle\Listener;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class AcceptCookieListener
{
    public function checkAcceptCookie(FilterResponseEvent $event)
    {
        $response = $event->getResponse();
        $request  = $event->getRequest();

        $acceptCookie = (bool)$event->getRequest()->query->get('AcceptCookie');
        $value = $request->cookies->get('AcceptCookie');

        if ($acceptCookie == true){
          $cookie = new Cookie('AcceptCookie', 'true', time() + 3600 * 24 * 7);
          $response->headers->setCookie($cookie);
        }
    }
}
