<?php

namespace App\Repository;

use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Mapping\OrderBy;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }

     /**
      * @return Produit[] Returns an array of Produit objects
      */
    

     public function listeproduitcategorie($categorie)
     {
 
        return $this->createQueryBuilder("p")
        
        ->where("p.category = :categorie")
        ->setParameter("categorie", $categorie)
        ->orderBy("p.category")
       
        ->getQuery()
        ->getResult()
        
        ;
    }
    public function listeCategorie(){
        return $this->createQueryBuilder("p")
        ->distinct("p.category")
        ->select("p.category")

        ->getQuery()
        ->getResult()
        ;
    }


    /*
    * recherche les produit en foncition du form
    * @return void 
    */
    public function search($value){
        return $this->createQueryBuilder('p')// on donne l'alias de la table produit
        ->where("p.nom LIKE :mot ")
        ->orWhere("p.category LIKE :mot")
        ->orWhere("p.marque LIKE :mot") 
        ->setParameter("mot","%". $value ."%")
        ->setMaxResults(5)
        ->addOrderBy("p.nom")
        ->getQuery()
        ->getResult()
        ;
        

    }

    public function affichagebestseller(){
    //foinction a modifié par la suite en fonction du nombre de produit acheter
        return $this->createQueryBuilder("p")
        // ->select("*")
        ->orderBy("p.category")
        ->setMaxResults(3)
        ->getQuery()
        ->getResult()
        
        ;
        
    
    }
    /*
    public function findOneBySomeField($value): ?Produit
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
