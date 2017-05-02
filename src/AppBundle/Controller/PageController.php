<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction()
    {
        return $this->render('AppBundle:Page:index.html.twig');
    }

    public function aboutAction()
    {
        return $this->render('AppBundle:Page:about.html.twig');
    }

    public function contactAction()
    {
        return $this->render('AppBundle:Page:contact.html.twig');
    }

    public function adminAction()
    {
        return $this->render('AppBundle:Page:admin.html.twig');
    }
}
