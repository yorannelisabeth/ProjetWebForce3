<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/')]
class HomeController extends AbstractController
{
    #[Route('/', name:'home')]
    function index(ProduitRepository $Pr): Response
    {
        return $this->render('home/index.html.twig', [

            'liste_categories' => $Pr->listecategorie('$categorie'),
            'affichageBestSeller' => $Pr->affichagebestseller()
        ]);
    }

    #[Route('/produit/categorie/{category}', name:'productByCategorie')]
    function index1(ProduitRepository $Pr, $category): Response
    {

        return $this->render('produit/productByCategorie.html.twig', [

            'listeproduitcategorie' => $Pr->listeproduitcategorie($category),
            'liste_categories' => $Pr->listecategorie('$categorie')
            

        ]);

}

}
