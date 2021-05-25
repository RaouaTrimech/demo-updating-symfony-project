<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListeProjetController extends AbstractController
{
    #[Route('/liste/projet', name: 'liste_projet')]
    public function showProjectList(): Response
    {
        $articles = $this->getDoctrine()->getRepository("App:Project")->findAll();

        return $this->render('liste_projet/index.html.twig',[
            'project' => $articles
        ]);
    }


}
