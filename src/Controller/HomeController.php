<?php


namespace App\Controller;




use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]

    public function index(ProduitRepository $Pr): Response
    {
      return $this->render('home/index.html.twig', [
            

            'liste_categories'=>$Pr->listecategorie('$categorie')
       ]);
    }
    
}
