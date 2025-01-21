<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * Route pour aller au home du site
     */
    #[Route('/', name: 'home')]
    public function home(): Response
    {
        return $this->render('home/index.html.twig');
    }
    /**
     * Route pour aller voir le catalogue des articles
     */
    #[Route('/catalogue', name: 'catalogue')]
    public function catalogue(): Response
    {
        return $this->render('catalogue/index.html.twig',);
    }
    /**
     * Route pour aller voir le détail d'un article
     */
    #[Route('/catalogue/{id}', name: 'details',)]
    public function details(int $id): Response
    {
        return $this->render('catalogue/details.html.twig',);
    }

    /**
     * Route pour contacter la boite
     */
    #[Route('/contact', name: 'contact')]
    public function contact(): Response
    {
        return $this->render('contact/index.html.twig');
    }
}
