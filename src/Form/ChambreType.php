<?php
namespace App\Form;

use App\Entity\Chambre;
use App\Entity\Batiment;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
class ChambreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom', TextType::class)
            ->add('Etat', ChoiceType::class,
            [
                'choices' => [
                    'Occupee' => 'Occupee',
                    'Libre' => 'Libre',
                    'Libre_Libre' => 'Libre_Libre',
                ],
                'placeholder' => 'Sélectionnez un etat',
                'attr' => ['class' => 'form-control']
            ]
            
            )
            ->add('Statut', ChoiceType::class, [
                'choices' => [
                    'Magasin' => 'Magasin',
                    'Équipée' => 'Equipee',
                    'Non équipée' => 'Nonequipee',
                ],
                'placeholder' => 'Sélectionnez un statut',
                'attr' => ['class' => 'form-control']
            ])
            ->add('Localisation', TextType::class)
            ->add('Position', TextType::class)
            ->add('batiment', EntityType::class, [
                'class' => Batiment::class,
                'choice_label' => 'Nom', 
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Chambre::class,
        ]);
    }
}
