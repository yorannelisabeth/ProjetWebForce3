<?php

namespace App\Controller;

use App\Form\SearchProduitType;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ProduitRepository $pr, Request $request): Response
    {
        $form = $this->createForm(SearchProduitType::class);
    
        $search = $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // On recherche les annonces correspondant aux mots clés
                $Produit = $pr->search($search->get('mot')
                
                
            );
        }
        


        return $this->render('home/index.html.twig', [
            
            'produits'=> $pr->search('mot'),
            'form' => $form->createView()
        ]);
    }
}
