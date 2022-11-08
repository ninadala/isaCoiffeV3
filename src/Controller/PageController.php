<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('page/index.html.twig', [
            
        ]);
    }

    #[Route('/onco-coiffure', name: 'onco-coiffure')]
    public function oncoCoiffure(): Response
    {
        return $this->render('page/onco.html.twig', [
            
        ]);
    }

    #[Route('/perruquerie', name: 'perruquerie')]
    public function perruquerie(): Response
    {
        return $this->render('page/perruquerie.html.twig', [
            
        ]);
    }

}
