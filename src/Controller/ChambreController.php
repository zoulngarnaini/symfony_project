<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Locataire;
use App\Entity\ChambreLocataire;
use App\Entity\Chambre;
use App\Entity\Paiement;
use App\Entity\Depense;
use App\Entity\Realisation;
use App\Entity\AnneeAcademiques;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
class ChambreController extends AbstractController
{
    #[Route('/chambre', name: 'Toutes_chambre')]
    public function index(EntityManagerInterface $entityManager): Response
    {
             // Récupération de toutes les chambres depuis la base de données
        $chambres = $entityManager->getRepository(Chambre::class)->findAll();

        // Rendu de la vue avec les données des chambres 
        return $this->render('chambre.html.twig', [
            'controller_name' => 'ChambreController',
            'message' => 'La liste de toutes les chambres',
            'chambres' => $chambres
        ]);
    }   
   
    #[Route('/details_chambre/{id}', name: 'app_det_chambre')]
    public function detailsChambre(EntityManagerInterface $entityManager, int $id): Response
    {
        //  la chambre par son ID
        $chambre = $entityManager->getRepository(Chambre::class)->find($id);
    
        if (!$chambre) {
            throw $this->createNotFoundException('Chambre introuvable, veuillez réessayer.');
        }
        // les locataires associés à la chambre
        $locataires = $entityManager->getRepository(ChambreLocataire::class)->findBy(['chambre' => $chambre]);
    
        //  un tableau pour les paiements associés aux locataires
        $chambresAvecPaiements = [];
        foreach ($locataires as $chambreLocataire) {
            $paiements = $entityManager->getRepository(Paiement::class)->findBy(['chambreLocataire' => $chambreLocataire]);
    
            $chambresAvecPaiements[] = [
                'locataire' => $chambreLocataire->getLocataire(),
                'anneeAcademique' => $chambreLocataire->getAnneeAcademique(),
                'paiements' => $paiements
            ];
        }
    
        // Récupérer les dépenses associées à la chambre
        $depenses = $entityManager->getRepository(Depense::class)->findBy(['chambre' => $chambre]);
    
        // Récupérer les réalisations associées à la chambre
        $realisations = $entityManager->getRepository(Realisation::class)->findBy(['chambre' => $chambre]);
    
        return $this->render('chambre/details.html.twig', [
            'chambre' => $chambre,
            'chambresAvecPaiements' => $chambresAvecPaiements,
            'depenses' => $depenses,
            'realisations' => $realisations,
        ]);
    }
    
    
}
