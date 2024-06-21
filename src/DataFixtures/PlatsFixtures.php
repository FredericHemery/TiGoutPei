<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Plats;
use App\Repository\CategorieRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PlatsFixtures extends Fixture
{
    private $categorieRepository;
    public function __construct(CategorieRepository $categorieRepository)
// je declare la dépendance avec la classe categorieRepository dans le constructeur
    {
        $this->categorieRepository = $categorieRepository;
    }
    public function load(ObjectManager $manager): void
    {
        // Je récupere toutes les catégories de la base de données
        $categories = $this->categorieRepository->findAll();
        for ($i = 1; $i <= 20; $i++)
        {
            $faker = \Faker\Factory::create();
            $prixHT= $faker->randomFloat(null,2,50.23);
            $prixTTC= $prixHT*1.1;
            $prixRevient= $prixHT/1.15;
            $plat = new Plats();
            $plat->setNomPlat($faker->word);
            $plat->setDescriptionPlat($faker->sentence(20,true));
            $plat->setPrixVenteHTPlat($prixHT);
            $plat->setPrixVenteTTCPlat($prixTTC);
            $plat->setPrixRevient($prixRevient);
            $plat->setImgDescription($faker->sentence(3,true));
            $plat->setNomImage($faker->word);
            $plat->setQuantite($faker->optional(0.7,null)->randomDigit(1,9));
            // Affecte une catégorie aleatoirement

            $randomCategory = $categories[array_rand($categories)];
            $plat->setCategoriePlat($randomCategory);

            $manager->persist($plat);
        }
        $manager->flush();
    }
}
