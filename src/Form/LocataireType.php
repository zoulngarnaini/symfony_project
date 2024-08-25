<?php
namespace App\Form;
use App\Entity\Locataire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class LocataireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Le nom du locataire'],
                'label_attr' => ['class' => 'col-sm-3 col-form-label']
            ])
            ->add('prenom', TextType::class, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Le prenom du locataire'],
                'label_attr' => ['class' => 'col-sm-3 col-form-label']
            ])
            ->add('telephone', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-3 col-form-label']
            ])
            ->add('genre', ChoiceType::class, [
                'choices' => [
                    'Masculin' => 'Masculin',
                    'Féminin' => 'Féminin',
                ],
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-3 col-form-label']
            ])
            ->add('adresse', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-3 col-form-label']
            ])
            ->add('email', EmailType::class, [
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-3 col-form-label']
            ])
            ->add('niveau', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-3 col-form-label']
            ])
            ->add('filiere', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-3 col-form-label']
            ])
            ->add('dateNaissance', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control', 'placeholder' => 'dd/mm/yyyy'],
                'label_attr' => ['class' => 'col-sm-3 col-form-label']
            ])
            ->add('lieuNaissance', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label_attr' => ['class' => 'col-sm-3 col-form-label']
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => ['class' => 'btn btn-primary col-12 mt-3']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Locataire::class,
        ]);
    }
}
