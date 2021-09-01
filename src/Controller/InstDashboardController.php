<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InstDashboardController extends AbstractController
{
    /**
     * @Route("/instructor", name="inst_dashboard")
     */
    public function index(): Response
    {

        return $this->render('FrontOffice/InstructorPortal/index.html.twig'
        );
    }
}
