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
    public function Create(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator, Plats $plats = null): Response
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
        //je récupere le formulaire créé avec dans le formType avec sa verification de données
        $platsForm = $this->createForm(PlatsType::class, $plats);
        // je recupere ici les données envoyées par le formulaire twig(ou pas)
        $platsForm->handleRequest($request);

        //je verifie que le formulaire a bien été envoyé et que les données sont conforme a ce qui est attendu
        if ($platsForm->isSubmitted() && $platsForm->isValid()) {
            //si c'est une création, je verifie que le plat n'existe pas déja
            if ($modification === false) {
                $platExiste = $entityManager->getRepository(Plats::class)->findOneBy(['nomPlat' => $plats->getNomPlat()]);
                //si le plat existe deja, je le signale
                if ($platExiste !== null) {
                    $this->addFlash('error', 'le nom du plat existe deja');
                    return $this->render('admin/create.html.twig', [
                        'platsForm' => $platsForm->createView(),
                        'plats' => $plats
                    ]);
                }
            }
            //todo: approfondir l'aspect comptabilité
            //bien penser a arrondir! les prix sont stockés en float en BDD

            //recuperations de données monétaires du formulaire
            $prixRevient = $platsForm->get('prixRevient')->getData();
            $prixHT = $platsForm->get('prixVenteHTPlat')->getData();
            $prixTTC = $platsForm->get('prixVenteTTCPlat')->getData();


            // l'aspect comptable n'est pas encore aboutis. Comme la base de donnée attend des valeurs,
            //j'en crée par défaut meme si l'utilisateur n'en rentre pas

            if ($prixHT == null) {
                // si le prix ht n'est pas renseigné, la TVA forfaitaire de 10% est appliquée
                $plats->setPrixVenteHTPlat($prixTTC / 1.1);
            }
            if ($prixRevient == null) {
                // si le prix de reviens n'est pas spécifié, le mettre par defaut a 0
                $plats->setPrixRevient(0);
            }

            // je prépare les données récupérée (par le formulaire de création ou de modification)
            $entityManager->persist($plats);
            // j'execute l'ordre d'enregistrer ces données en BDD
            $entityManager->flush();

            if ($modification) {
                $this->addFlash('success', 'plat modifié avec succes');
            } else {
                $this->addFlash('success', 'plat ajouté à la liste');
            }
            return $this->redirectToRoute('app_admin_create');

        }

        return $this->render('admin/create.html.twig', [
            'platsForm' => $platsForm->createView(),
            'plats' => $plats
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
    public function Delete(EntityManagerInterface $entityManager, PlatsRepository $platsRepository, Plats $plats): Response
    {
        $idPlat = $plats->getId();
        $nomPlat = $plats->getNomPlat();
// si l'id a bien été envoyé, traite la demande
        if ($idPlat) {
            // Supprime le plat de la base de données
            $entityManager->remove($plats);
            $entityManager->flush();
            $this->addFlash('success', 'Plat ' . $nomPlat . '  supprimé avec succès');
        } else {
            $this->addFlash('error', 'Plat ' . $nomPlat . '  introuvable');
        }

        return $this->redirectToRoute('app_admin_plats');
    }

    #[Route(path: '/modifierCarte/modifierPlat/{id}', name: 'app_mod_plats')]
    public function modifier(Request $request, EntityManagerInterface $entityManager, Plats $plats)
    {
        $idPlat = $plats->getId();
        $plat = $entityManager->getRepository(Plats::class)->find($idPlat);

        // reprendre le create du sortirProjet le comprendre et tenter de repartir de la.
        //soit l'integrer dans le Create (ce qui serait logique. juste passer en parametres les elements modifiés)
        //peut etre passer par modifier pour ensuite envoyer les elements a create pour faire le persist


        return $this->render('admin/carte/modifierPlat.hmtl.twig', [
            'controller_name' => 'AdminController',
            'plats' => $plat
        ]);

    }

}
