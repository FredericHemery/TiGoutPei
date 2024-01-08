<?php

namespace App\Controller;

use App\Repository\PlatsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route(path:'/admin',name:'' )]
class AdminController extends AbstractController
{
    #[Route(path:'', name: 'app_admin')]
    public function Interface(): Response
    {
        return $this->render('admin/admin.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route(path:'/modifierCarte', name: 'app_admin_plats')]
    public function Afficherplats(EntityManagerInterface $entityManager, PlatsRepository $platsRepository): Response
    {
        $plats=$platsRepository->findAll();
        dump($plats);
        return $this->render('admin/carte/modifierCarte.html.twig', [
            'controller_name' => 'AdminController',
            'plats'=>$plats
        ]);
    }

    #[Route(path:'/modifierCarte/suprimerPlat', name: 'app_supp_plats')]
    public function Delete(EntityManagerInterface $entityManager, PlatsRepository $platsRepository): Response
    {
        //todo: mettre en place suppression de plats
        return $this->render('admin/carte/modifierCarte.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
