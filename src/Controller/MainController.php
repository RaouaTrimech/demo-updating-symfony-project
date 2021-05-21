<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
/**
* @Route("",name="mainPage")
*/
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
/**
* @Route("/products",name="productPage")
*/
    public function products(): Response
    {
        return $this->render('main/products.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
    /**
     * @Route("/projects",name="projectPage")
     */
    public function projects(): Response
    {
        return $this->render('main/projects.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}