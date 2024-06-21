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

    #[Route(path: '/creerPlat/{id?}', name: 'app_admin_create')]
    public function Create(Request $request, EntityManagerInterface $entityManager, Plats $plats = null): Response
    {
        if ($plats === null) {
            //c'est une création, je crée une nouvelle instance de plat
            $plats = new Plats();
            //$modification sert a verifier si c'est une modification ou une création de plat,
            // pour adapter le message de confirmation
            $modification = false;
        } else {
            $modification = true;
        }
        $nomPlatDebut = $plats->getNomPlat();
        //je récupere le formulaire créé dans le formType avec sa verification de données
        $platsForm = $this->createForm(PlatsType::class, $plats);
        // je recupere ici les données envoyées par le formulaire
        $platsForm->handleRequest($request);

        //je verifie que le formulaire a bien été envoyé et que les données sont conforme a ce qui est attendu
        if ($platsForm->isSubmitted() && $platsForm->isValid()) {

            //todo: approfondir l'aspect comptabilité
            //bien penser a arrondir! les prix sont stockés en float en BDD

            //recuperations de données monétaires du formulaire
            $prixRevient = $platsForm->get('prixRevient')->getData();
            $prixHT = $platsForm->get('prixVenteHTPlat')->getData();
            $prixTTC = $platsForm->get('prixVenteTTCPlat')->getData();

            // l'aspect comptable n'est pas encore aboutis. Comme la base de donnée attend des valeurs,
            //j'en crée par défaut meme si l'utilisateur n'en rentre pas

            if ($prixHT === null) {
                // si le prix ht n'est pas renseigné, la TVA forfaitaire de 10% est appliquée
                $plats->setPrixVenteHTPlat($prixTTC / 1.1); //todo: simplifier
            }
            if ($prixRevient === null) {
                $plats->setPrixRevient(0);
            }

            // je prépare les données récupérée (par le formulaire de création ou de modification)
            $entityManager->persist($plats);
            // j'execute l'ordre d'enregistrer ces données en BDD
            $entityManager->flush();
            // création d'un message de succes
            if ($modification) {
                //je prend le nom du plat enregistré
                $nomPlat = $plats->getNomPlat();
                //je compare le nom du plat enregistré avec le nom d'origine
                if ($nomPlatDebut !== $nomPlat) {
                    //si celui ci est different, je passe l'ancien nom en message pour verifier que
                    // l'on a changé le bon article
                    $this->addFlash('success', '" ' . $nomPlatDebut . ' "' . ' modifié avec succes en ' . '" ' . $nomPlat . ' "');
                } else {
                    $this->addFlash('success', $nomPlat . ' modifié avec succes');
                }
                return $this->redirectToRoute('carte_plats');
            } else {
                $this->addFlash('success', 'plat ajouté à la Carte');
            }
            return $this->redirectToRoute('app_admin_create');
        }

        return $this->render('admin/create.html.twig', [
            'platsForm' => $platsForm->createView(),
            'plats' => $plats
        ]);
    }

    #[Route(path: '/modifierCarte/suprimerPlat/{id}', name: 'app_supp_plats')]
    public function Delete(EntityManagerInterface $entityManager, PlatsRepository $platsRepository, Plats $plats = null): Response
    {
// si $plat existe, traite la demande
        if ($plats) {
            $nomPlat = $plats->getNomPlat();
            // Supprime le plat de la base de données
            $entityManager->remove($plats);
            $entityManager->flush();
            $this->addFlash('success', 'Plat ' . $nomPlat . '  supprimé avec succès');
        }

        return $this->redirectToRoute('carte_plats');
    }

//    #[Route(path: '/creerPlat/{id?}', name: 'app_admin_create')]
//    public function Create(Request $request, EntityManagerInterface $entityManager, Plats $plats = null): Response
//    {
//        if ($plats === null) {
//            //c'est une création, je crée une nouvelle instance de plat
//            $plats = new Plats();
//
//        }
//        //je récupere le formulaire créé dans le formType avec sa verification de données
//        $platsForm = $this->createForm(PlatsType::class, $plats);
//        // je recupere ici les données envoyées par le formulaire
//        $platsForm->handleRequest($request);
//
//        //je verifie que le formulaire à bien été envoyé et que les données sont conformes à ce qui est attendu
//        if ($platsForm->isSubmitted() && $platsForm->isValid()) {
//
//            // je prépare les données récupérées (par le formulaire de création ou de modification)
//            $entityManager->persist($plats);
//            // j'execute l'ordre d'enregistrer ces données en BDD
//            $entityManager->flush();
//
//            return $this->redirectToRoute('app_admin_create');
//        }
//
//        return $this->render('admin/create.html.twig', [
//            'platsForm' => $platsForm->createView(),
//            'plats' => $plats
//        ]);
//    }

}
