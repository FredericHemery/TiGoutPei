<?php

namespace App\Controller;

use App\Repository\PlatsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/carte', name:'carte_')]
class CarteController extends AbstractController
{
    #[Route(path:'', name: 'plats')]
    public function plats(EntityManagerInterface $entityManager, PlatsRepository $platsRepository): Response
    {

        $plats=$platsRepository->findAll();
        //todo: afficher la liste des plats
        return $this->render('carte/laCarte.html.twig', [
            'controller_name' => 'CarteController',
            'plats'=>$plats
        ]);
    }

    #[Route(path:'/details/{id}', name:'details')]
public function details( int $id): Response
    {
        //todo: afficher le detail d'un plat
        dd('détails à afficher');

    }
}
