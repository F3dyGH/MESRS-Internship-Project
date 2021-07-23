<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function indexBack(): Response
    {
        return $this->render('BackOffice/base.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }
    /**
     * @Route("/home", name="educati")
     */
    public function indexFront(): Response
    {
        return $this->render('FrontOffice/base.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }
}
