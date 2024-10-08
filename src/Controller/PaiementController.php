<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\AnneeAcademiques;
use App\Entity\Tranche;
use App\Entity\Paiement;
use Doctrine\ORM\EntityManagerInterface;
class PaiementController extends AbstractController
{
    #[Route('/paiement', name: 'app_paiement')]
    public function index(EntityManagerInterface $entityManager): Response
    {
    $paiements = $entityManager->getRepository(Paiement::class)->findAll();
    foreach ($paiements as $paiement) {
        if (!$paiement->getChambreLocataire() || !$paiement->getChambreLocataire()->getLocataire()) {
            $paiement->getChambreLocataire()->setLocataire(null);
        }
    }
    $tranches = $entityManager->getRepository(Tranche::class)->findAll();
    $annees = $entityManager->getRepository(anneeAcademiques::class)->findAll();

    return $this->render('/paiement/paiement.html.twig', [
        'controller_name' => 'PaiementController',
        'message' => 'Liste de tous les paiements',
        'paiements' => $paiements,
        'annees' => $annees,
        'tranches' => $tranches,
    ]);
}
}
