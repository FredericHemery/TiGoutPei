<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoriesFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // je crée les catégories
        $categories = ['apero', 'grignote', 'plat', 'dessert'];

        foreach ($categories as $libelle) {
            // je crée une nouvelle instance de Categorie
            $categorie = new Categorie();
            $categorie->setLibelle($libelle);

            // Persiste l'entité
            $manager->persist($categorie);
        }

        // j'execute les requêtes pour enregistrer les catégories en base de données
        $manager->flush();
    }
}