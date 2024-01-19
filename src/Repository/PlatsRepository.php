<?php

namespace App\Repository;

use App\Entity\Plats;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use \App\Model\SearchData;

/**
 * @extends ServiceEntityRepository<Plats>
 *
 * @method Plats|null find($id, $lockMode = null, $lockVersion = null)
 * @method Plats|null findOneBy(array $criteria, array $orderBy = null)
 * @method Plats[]    findAll()
 * @method Plats[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlatsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Plats::class);
    }


    /**
     * recupere les plats qui correspondent au mot clé renseigné
     */
    public function findBySearch(SearchData $searchData):array
    {
        // J'initialise ma requête sur la table "plats"
        $plats = $this->createQueryBuilder('plats');

        // Si des mots-clés sont fournis, je les cherches dans les noms de plat ou dans la description
        if (!empty($searchData->mots) && preg_match('/^[a-zA-Z0-9\s\']+$/u', $searchData->mots)) {
            $plats = $plats
                ->where('plats.nomPlat LIKE :mot OR plats.descriptionPlat LIKE :mot')
                ->setParameter('mot', "%{$searchData->mots}%");
        }

        // Je retourne les résultats obtenus par ordre alphabétique du nom du plat
        return $plats
            ->orderBy('plats.nomPlat', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
