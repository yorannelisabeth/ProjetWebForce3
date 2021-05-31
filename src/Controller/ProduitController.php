<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface as EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/produit')]
class ProduitController extends AbstractController
{
    #[Route('/' ,name: 'produit_index', methods: ['GET'])]
    public function index(ProduitRepository $produitRepository): Response
    {
        return $this->render('produit/index.html.twig', [
            'produits' => $produitRepository->findAll(),  /*Pour recupe tous les enregistrements de la table et retourner une liste */
            'liste_categories'=>$produitRepository->listecategorie()
            
        ]);
    
    }


    #[Route('/new', name: 'produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManager $em , ProduitRepository $pr )
    {
        $produit = new Produit();// creation d'un objet de la class Produit
        $formProduit = $this->createForm(ProduitType::class, $produit);
        $formProduit->handleRequest($request); /* permet à $formProduit de gérer les informations envoyées par le 
        navigateur */

        if ($formProduit->isSubmitted() && $formProduit->isValid()) {

            $nouveauProduit = $formProduit ->getData(); // pour créer un nouveau produit 

            $destination = $this->getParameter("dossier_images"); //le dossier dans lequel la photo sera telechargée

            if($photoTelechargee = $formProduit->get("photo")->getData()){ // si une photo est telechargée

                $nomPhoto = pathinfo($photoTelechargee->getClientOriginalName(), PATHINFO_FILENAME); // je recup le nom de cette photo dans $nomPhoto

                $nouveauNom = str_replace(" ", "_", $nomPhoto); // remplacer des espaces par des photos

                $nouveauNom .= "-" . uniqid() . "." . $photoTelechargee->guessExtension(); // on precise les extensions pour eviter 
                //d'avoir deux fichiers avec deux noms

                $photoTelechargee->move($destination, $nouveauNom); // enregistrement de la photo dans le fichier $destination

                $nouveauProduit->setPhoto($nouveauNom); // mise à jour du nom de la photo

                $em->persist($nouveauProduit);
                $em->flush();

            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($produit);
            $entityManager->flush();
            return $this->redirectToRoute('produit_index');
        }

        return $this->render('produit/new.html.twig', ['form' => $formProduit->createView(),
        'liste_categories'=>$pr->listecategorie()
        ]);
    }


    #[Route('/{id}', name: 'produit_show', methods: ['GET'])]
    public function show(Produit $produit, ProduitRepository $pr): Response{
        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
            'liste_categories'=>$pr->listecategorie()
        ]);
    }


    #[Route('/{id}/edit', name: 'produit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request,EntityManager $em, Produit $produit, ProduitRepository $pr): Response
    {
    
        $formProduit = $this->createForm(ProduitType::class, $produit);
        $formProduit->handleRequest($request);

        if ($formProduit->isSubmitted() && $formProduit->isValid()) {
            $em->flush();

            return $this->redirectToRoute('produit_index');
        }

        return $this->render('produit/new.html.twig', ['form' => $formProduit->createView(),
        'liste_categories'=>$pr->listecategorie()]);
    }


    #[Route('/{id}', name: 'produit_delete', methods: ['POST'])]
    public function delete(EntityManager $em,Request $request, Produit $produit,ProduitRepository $pr): Response
    {
        if ($this->isCsrfTokenValid('delete'.$produit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($produit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('produit_index');
     return $this->render('produit/delete.html.twig', ["produit" => $produit,
        'liste_categories'=>$pr->listecategorie()]);
    }
}