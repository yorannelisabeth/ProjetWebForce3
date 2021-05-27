<?php

namespace App\Controller;
use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ProfilController extends AbstractController
{
    /**
     * @Route("/profil" , name="profil")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
    
     */
    
    public function index(ProduitRepository $Pr): Response
    {
        return $this->render('profil/index.html.twig', [
            
            'liste_categories'=>$Pr->listecategorie()
        ]);
    }
}
