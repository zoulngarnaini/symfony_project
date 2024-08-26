<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\LocataireType;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Locataire;
use App\Entity\ChambreLocataire;
use App\Entity\Chambre;
use App\Entity\Paiement;
use App\Entity\AnneeAcademiques;

class LocataireController extends AbstractController
{
    #[Route('/locataire', name: 'app_locataire')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $locataires = $entityManager->getRepository(Locataire::class)->findAll();
        return $this->render('/locataire/locataire.html.twig', [
            'controller_name' => 'LocataireController',
            'message' => 'Les locataires d\'Oval City',
            'locataires' => $locataires
        ]);
    }

    #[Route('/locataire/new', name: 'app_new_loc')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $locataire = new Locataire();
        $form = $this->createForm(LocataireType::class, $locataire);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($locataire);
            $entityManager->flush();

            // Redirection après l'enregistrement
            $this->addFlash('success', 'Locataire enregistre avec succès!');

            return $this->redirectToRoute('app_locataire');
        }

        return $this->render('locataire/new_loc.html.twig', [
            'form' => $form->createView(),
        ]);
    }
 



    //
    #[Route('/details_loc/{id}', name: 'app_det_loc')]
    public function detailsLocat(EntityManagerInterface $entityManager, int $id): Response
    {
        // Récupérer le locataire par son ID
        $locataire = $entityManager->getRepository(Locataire::class)->find($id);
    
        if (!$locataire) {
            throw $this->createNotFoundException('Locataire introuvable');
        }
    
        // les chambres associées au locataire
        $chambres = $entityManager->getRepository(ChambreLocataire::class)->findBy(['locataire' => $locataire]);
    
        // un tableau pour les paiements associés aux chambres
        $chambresAvecPaiements = [];
        foreach ($chambres as $chambreLocataire) {
            $paiements = $entityManager->getRepository(Paiement::class)->findBy(['chambreLocataire' => $chambreLocataire]);
            $chambresAvecPaiements[] = [
                'chambre' => $chambreLocataire,
                'paiements' => $paiements
            ];
        }
    
        return $this->render('locataire/details.html.twig', [
            'locataire' => $locataire,
            'chambresAvecPaiements' => $chambresAvecPaiements,
        ]);
    }
     

     #[Route('/locataire/{id}/edit', name: 'locataire_edit')]
    public function edit(Request $request, Locataire $locataire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LocataireType::class, $locataire);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'Locataire modifié avec succès!');

            return $this->redirectToRoute('app_locataire');
        }

        return $this->render('locataire/edit.html.twig', [
            'locataire' => $locataire,
            'form' => $form->createView(),
        ]);
    }
        
    #[Route('/locataire/{id}/delete', name: 'locataire_delete')]
      //#[Route('/locataire/{id}/delete', name='locataire_delete')]
     
    public function delete(Request $request, Locataire $locataire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$locataire->getId(), $request->request->get('_token'))) {
            $entityManager->remove($locataire);
            $entityManager->flush();

            $this->addFlash('success', 'Locataire supprimé avec succès!');
        }

        return $this->redirectToRoute('app_locataire');
    }
       
}
