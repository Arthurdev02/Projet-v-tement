<?php

namespace App\Controller;

use App\Entity\Clothing;
use App\Repository\ClothingRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClothingController extends AbstractController
{
    #[Route('/clothing', name: 'app_clothing')]
    public function index(ClothingRepository $clothingRepository): Response
    {
        $clothings = $clothingRepository->findAll();
        return $this->render('clothing/index.html.twig', [
            'clothings' => '$clothings',
        ]);
    }

    #[Route('clothing/{id}', name: 'clothing_show')]
    public function show(Clothing $clothing): Response
    {
        return $this->render('clothing/show.html.twig', [
            'clothing' => $clothing,
        ]);
    }
}
