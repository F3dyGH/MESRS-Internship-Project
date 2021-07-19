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
        return $this->render('BackOffice/login.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }
    /**
     * @Route("/educati", name="educati")
     */
    public function indexFront(): Response
    {
        return $this->render('FrontOffice/base.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }
}
