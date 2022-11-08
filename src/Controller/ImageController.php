<?php

namespace App\Controller;

use App\Entity\Image;
use App\Form\ImageType;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ImageController extends AbstractController
{
    #[Route('/admin-image', name: 'admin-image')]
    #[IsGranted('ROLE_USER')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Image::class);
        $images = $repository->findAll();
        return $this->render('image/index.html.twig', [
            'images' => $images,
        ]);
    }

    #[Route('/create-image', name: 'create-image')]
    #[IsGranted('ROLE_USER')]
    public function create(ManagerRegistry $doctrine, Request $request): Response
    {
        $image = new Image();
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($image);
            $em->flush();
            return $this->redirectToRoute('admin-image');
        }

        return $this->render('image/create.html.twig', [
            'image' => $image,
            'form'  => $form->createView()
        ]);
    }

    #[Route('/delete-image/{id}', name: 'delete-image')]
    #[IsGranted('ROLE_USER')]
    public function delete(ManagerRegistry $doctrine, Image $image): Response
    {
        $em = $doctrine->getManager();
        $em->remove($image);
        $em->flush();

        return $this->redirectToRoute('admin-image');
    }

    #[Route('/galerie', name: 'galerie')]
    public function galerie(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Image::class);
        $images = $repository->findAll();
        return $this->render('page/galerie.html.twig', [
            'images' => $images,
        ]);
    }
}
