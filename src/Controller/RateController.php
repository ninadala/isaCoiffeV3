<?php

namespace App\Controller;

use App\Entity\Rate;
use App\Form\RateType;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RateController extends AbstractController
{
    
    #[Route('/tarifs', name: 'tarifs')]
    public function tarifs(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Rate::class);
        $rates = $repository->findAll();
        return $this->render('page/tarifs.html.twig', [
            'rates' => $rates
        ]);
    }
    
    #[Route('/admin-tarifs', name: 'admin-tarifs')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Rate::class);
        $rates = $repository->findAll();
        return $this->render('rate/index.html.twig', [
            'rates' => $rates
        ]);
    }

    #[Route('/rate/new', name:"create-rate")]
    #[IsGranted('ROLE_USER')]
    public function create(Request $request, ManagerRegistry $doctrine) : Response
    {
        $rate = new Rate();
        $form = $this->createForm(RateType::class, $rate);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($rate);
            $em->flush();
            return $this->redirectToRoute('admin-tarifs');
        }
        return $this->render('rate/form.html.twig', [
            "rate_form" => $form->createView()
        ]);
    }

    #[Route('/rate/delete/{id<\d+>}', name:"delete-rate")]
    #[IsGranted('ROLE_USER')]
    public function delete(Rate $rate, ManagerRegistry $doctrine) : Response
    {
        $em = $doctrine->getManager();
        $em->remove($rate);
        $em->flush();

        return $this->redirectToRoute("admin-tarifs");
    }

    #[Route('/rate/edit/{id<\d+>}', name:"edit-rate")]
    #[IsGranted('ROLE_USER')]
    public function update(Rate $rate, Request $request, ManagerRegistry $doctrine) : Response
    {
        $form = $this->createForm(RateType::class, $rate);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute('admin-tarifs');
        }
        return $this->render('rate/form.html.twig', [
            "rate_form" => $form->createView()
        ]);
    }
}
