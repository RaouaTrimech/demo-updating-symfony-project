<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectDisplayController extends AbstractController
{
    #[Route('/project/display', name: 'project_display')]
    public function index(): Response
    {
        return $this->render('project_display/index.html.twig', [
            'controller_name' => 'ProjectDisplayController',
        ]);
    }
}
