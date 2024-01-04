<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route(path: '/')]
class MainController extends AbstractController
{
    #[Route(path: 'accueil', name: 'accueil')]
    public function Accueil(): Response
    {
        return $this->render('main/accueil.html.twig');
    }


}
