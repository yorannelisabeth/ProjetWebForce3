<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'search')]
    public function index(Request $rq, ProduitRepository $Pr): Response
    {
        /* on recupere le mot entré ds la barre de recherche */

        $mot = $rq->query->get("mot");
        $Produit = $Pr->search($mot);
        $liste_categories = $Pr->listeCategorie();
        
        /* $produit = $Pr->search($mot); */

        

        return $this->render('search/index.html.twig',
        compact("mot","Produit","liste_categories"),
        
        
    );

        //return $this->render('search/index.html.twig', [
           // 
            /* $motRechercher = $rq->query->get("mot"), */
            //'mot'=>$Pr->search($motRechercher)
       // ]);
    }
}
