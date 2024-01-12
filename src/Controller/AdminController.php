<?php

namespace App\Controller;

use App\Entity\Plats;
use App\Form\PlatsType;
use App\Repository\PlatsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;


#[Route(path: '/admin', name: '')]
class AdminController extends AbstractController
{
    #[Route(path: '', name: 'app_admin')]
    public function Interface(): Response
    {
        return $this->render('admin/admin.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route(path: '/creerPlat', name: 'app_admin_create')]
    public function Create(Plats $plats,Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator): Response
    {


        ////////////////////////////PB de ID dans le path pour le lien amenant a la modification de plats twig admin////
        $id=$plats->getId();
        if ($id !== null) {
            // Si $id n'est pas null, c'est une modification, tu dois récupérer le plat existant
            $plats = $entityManager->getRepository(Plats::class)->find($id);
            dd($plats->getNomPlat());
        } else {
            // Sinon, c'est une création, tu instancies un nouveau plat
            dd('pas d\'id');
        $plats = new Plats();
        }
        $platsForm = $this->createForm(PlatsType::class, $plats);

        $platsForm->handleRequest($request);

        if ($platsForm->isSubmitted() && $platsForm->isValid()) {


            //todo: approfondir l'aspect comptabilité
            //bien penser a arrondir! stocké en float en BDD
//recuperations de données du formulaire
            $prixRevient = $platsForm->get('prixRevient')->getData();
            $prixHT = $platsForm->get('prixVenteHTPlat')->getData();
            $prixTTC = $platsForm->get('prixVenteTTCPlat')->getData();


            if ($prixHT == null) {
                // si le prix ht n'est pas renseigné, la TVA forfaitaire de 10% est appliquée
                $plats->setPrixVenteHTPlat($prixTTC / 1.1);
            }
            if ($prixRevient == null) {
                // si le prix de reviens n'est pas spécifié, le mettre par defaut a 0
                $plats->setPrixRevient(0);
            }

            $entityManager->persist($plats);
            $entityManager->flush();
            $this->addFlash('success', 'plat ajouté à la liste');
            return $this->redirectToRoute('app_admin_create');

        }

        return $this->render('admin/create.html.twig', [
            'platsForm' => $platsForm->createView(),
        ]);
    }


    #[Route(path: '/modifierCarte', name: 'app_admin_plats')]
    public function Afficherplats(EntityManagerInterface $entityManager, PlatsRepository $platsRepository): Response
    {
        $plats = $platsRepository->findAll();
        dump($plats);
        return $this->render('admin/carte/modifierCarte.html.twig', [
            'controller_name' => 'AdminController',
            'plats' => $plats
        ]);
    }

    #[Route(path: '/modifierCarte/suprimerPlat/{id}', name: 'app_supp_plats')]
    public function Delete(Plats $plats,EntityManagerInterface $entityManager, PlatsRepository $platsRepository): Response
    {
        $idPlat= $plats->getId();
        $nomPlat= $plats->getNomPlat();
// si l'id a bien été envoyé, traite la demande
        if ($idPlat) {
            // Supprime le plat de la base de données
            $entityManager->remove($plats);
            $entityManager->flush();
            $this->addFlash('success', 'Plat '.$nomPlat.'  supprimé avec succès');
        } else {
            $this->addFlash('error', 'Plat '.$nomPlat.'  introuvable');
        }

        return $this->redirectToRoute('app_admin_plats');
    }

}
