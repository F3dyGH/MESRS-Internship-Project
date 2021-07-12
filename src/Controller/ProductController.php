<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    /**
     * @Route("/admin/product/add", name="add_product")
     */
    public function add(Request $request): Response
    {
        $prod = new Product();
        $form = $this->createForm(ProductType::class, $prod);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($prod);
            $em->flush();
            return $this->redirectToRoute('list_product');
        }
        return $this->render('BackOffice/product/add.html.twig', [
            'controller_name' => 'ProductController',
            "form_title" => "Add Product",
            "form" => $form->createView(),
        ]);
    }

    /**
     * @Route ("admin/product/list", name="list_product")
     */
    public function list()
    {
        $prod = $this->getDoctrine()->getRepository(Product::class)->findAll();
        return $this->render("BackOffice/product/list.html.twig", [
            "product" => $prod,
        ]);
    }

    /**
     * @Route("admin/product/delete/{id}", name="delete_product")
     */
    public function delete(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $prod = $entityManager->getRepository(Product::class)->find($id);
        $entityManager->remove($prod);
        $entityManager->flush();
        return $this->redirectToRoute('list_product');
    }

    /**
     * @Route("admin/product/edit/{id}", name="edit_product")
     */
    public function edit(Request $request, int $id): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $prod = $entityManager->getRepository(Product::class)->find($id);
        $form = $this->createForm(ProductType::class, $prod);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            return $this->redirectToRoute('list_product');

        }
        return $this->render("BackOffice/product/edit.html.twig", [
            "form_title" => "Modifier vos informations",
            "form" => $form->createView(),
        ]);
    }
}
