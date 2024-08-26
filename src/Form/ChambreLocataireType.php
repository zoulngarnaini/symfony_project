<?php
namespace App\Form;

use App\Entity\ChambreLocataire;
use App\Entity\Chambre;
use App\Entity\Locataire;
use App\Entity\AnneeAcademiques;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChambreLocataireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('chambre', EntityType::class, [
                'class' => Chambre::class,
                'choice_label' => 'nom', 
                'label' => 'Chambre',
                'attr' => ['class' => 'form-control']
            ])
            ->add('locataire', EntityType::class, [
                'class' => Locataire::class,
                'choice_label' => 'nom', 
                'label' => 'Locataire',
                'attr' => ['class' => 'form-control']
            ])
            ->add('anneeAcademique', EntityType::class, [
                'class' => AnneeAcademiques::class,
                'choice_label' => 'nom', 
                'label' => 'Année Académique',
                'attr' => ['class' => 'form-control']
            ])
            ->add('dureeOccupation', IntegerType::class, [
                'label' => 'Durée d\'Occupation (en mois)',
                'attr' => ['class' => 'form-control']
            ]);
         
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ChambreLocataire::class,
        ]);
    }
}
