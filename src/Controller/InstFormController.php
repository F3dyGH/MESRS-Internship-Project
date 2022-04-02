<?php

namespace App\Controller;

use App\Entity\InstForm;
use App\Entity\Product;
use App\Entity\User;
use App\Form\InstformType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class InstFormController extends AbstractController
{
    /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/join-us", name="join")
     */
    public function add(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_STUD');
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        $instformm = $this->getDoctrine()->getRepository(InstForm::class)->findAll();
        $courses = $this->getDoctrine()->getRepository(Product::class)->findAll();
        $u = $this->security->getUser();
        $instForm = new InstForm();
        $form = $this->createForm(InstformType::class,$instForm);
        $form->handleRequest($request);
        $exist = $this->getDoctrine()->getRepository(Instform::class)->findOneBy(['inst' => $u]);
        if($exist){
            $form->isDisabled();
            //$this->addFlash('alert',"you already applied, wait for our admins approval");
            return $this->render("FrontOffice/become_instructor/already_applied.html.twig", [
                'controller_name' => 'InstFormController',
                "form_title" => "Request Instructor",
                "instform" => $form->createView(),
                "insform" => $instformm,
                "users"=>$users,
                "products"=>$courses
            ]);
        }
           else if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                // refresh CSRF token (form_intention)
                //$this->get("security.csrf.token_manager")->refreshToken("form_intention");
                $instForm->setInst($u);
                $instForm->setDate(new \DateTime('@' . strtotime('now')));
                $instForm->setUpdatedAt(new \DateTime('@' . strtotime('now')));
                $em->persist($instForm);
                $em->flush();
                return $this->redirectToRoute('succesrequest');
            }

           /* return $this->render('FrontOffice/InstructorPortal/index.html.twig'
            );*/
            return $this->render('FrontOffice/become_instructor/join.html.twig', [
                'controller_name' => 'InstFormController',
                "form_title" => "Request Instructor",
                "instform" => $form->createView(),
                "insform" => $instformm,
                "users"=>$users,
                "products"=>$courses
            ]);

    }

    /**
     * @Route ("/Success" ,name="succesrequest")
     */
    public function Success(){
        return $this->render('FrontOffice/become_instructor/success.html.twig');
    }
}
