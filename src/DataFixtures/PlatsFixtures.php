<?php

namespace App\DataFixtures;

use App\Entity\Plats;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PlatsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 20; $i++)
        {
            $alea= rand(0,3);

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
            //todo: mettre a jour avec table categorie
            switch ($alea) {
                case 0:
                    $plat->setCategorie("apero");
                    break;
                case 1:
                    $plat->setCategorie("grignote");
                    break;
                case 2:
                    $plat->setCategorie("plat");
                    break;
                case 3:
                     $plat->setCategorie("dessert");
                    break;
                default:
                    $plat->setCategorie("inconnu");
                    break;
            }
            $manager->persist($plat);
        }
        $manager->flush();
    }
}
