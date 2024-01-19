<?php

namespace App\Controller;

use App\Model\SearchData;
use App\Form\RechercheType;
use App\Repository\PlatsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/carte', name:'carte_')]
class CarteController extends AbstractController
{
    #[Route(path:'', name: 'plats')]
    public function plats(Request $request,PlatsRepository $platsRepository): Response
    {
        //j'instancie un nouvel objet SearchData et je crée le formulaire de recherche
        //en me servant du RecherchType et en y injectant les données de l'objet SearchData
        $searchData = new SearchData();
        $rechercheForm = $this->createForm(RechercheType::class, $searchData);

        //Gestion de la soumission du formulaire
        $rechercheForm->handleRequest($request);

        // si les données du formulaires sont bien envoyées et valides,
        if ($rechercheForm->isSubmitted()&&$rechercheForm->isValid()){
            //je lance une recherche par mot clé dans le PlatsRepository
            $platsRecherches= $platsRepository->findBySearch($searchData);

            return $this->render('carte/laCarte.html.twig', [
                'controller_name' => 'CarteController',
                'rechercheForm'=>$rechercheForm->createView(),
                'plats'=>$platsRecherches
            ]);
        }


        $plats=$platsRepository->findAll();
//j'envoie dans la vue twig tous les plats de l'entité plat
        return $this->render('carte/laCarte.html.twig', [
            'controller_name' => 'CarteController',
            'rechercheForm'=>$rechercheForm->createView(),
            'plats'=>$plats
        ]);
    }

}
