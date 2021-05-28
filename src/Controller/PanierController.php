<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'panier_index')]

    public function index( SessionInterface $session, ProduitRepository $produitRepository){

    
        $panier = $session -> get('panier', []); 

        $panierProduits = [];

        foreach($panier as $id => $quantité){

            $panierProduits[] = [
                'produit' => $produitRepository -> find($id),

                'quantité' => $quantité
            ];
        }
        return $this->render('panier/index.html.twig', [

            'items' => $panierProduits , 'liste_categories'=>$produitRepository->listecategorie('$categorie')
        ]);
    }

    #[Route('/ajout/{id}', name: 'panier_ajout')]

    public function ajoutPanier($id, SessionInterface $session ) {
        //sessionInterface qui est obtenu par le conteneur de servive par la commande 
        //symfony console debug:autowiring session


        $panier = $session -> get('panier', []); // Récupérer un panier dans ma session et si je n'en ai pas j'en recup 
        // un qui est un tableau d'où les crochets.

        if(!empty($panier[$id])){

            $panier[$id]++;
        }
        else{
            $panier [$id] = 1;// l'id qui respresente l'id d'un produit du panier a laquelle j'attribue la valeur 1 
        }
         // l'id qui respresente l'id d'un produit du panier a laquelle j'attribue la valeur 1 

        $session -> set('panier',$panier);



    }
}
