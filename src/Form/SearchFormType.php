<?php

namespace App\Form;

use App\Data\SearchData;
use App\Entity\Campus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('campus', EntityType::class, [
                'required' => false,
                'class'=>Campus::class,
                'choice_label'=> 'nom',
            ])
            ->add('q',TextType::class, [
                'label'=>'Le nom de la sortie contient : ',
                'required'=>false,
                'attr'=>['placeholder'=>'search']
            ])
            ->add('dateFrom', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('dateTo', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('sortiesOrga', CheckboxType::class, [
                'label' => "Sorties dont je suis l'organisateur",
                'required' => false,
            ])
            ->add('sortiesInscrit', CheckboxType::class, [
                'label' => 'Sorties auxquelles je suis inscrit',
                'required' => false,
            ])
            ->add('sortiesNonInscrit', CheckboxType::class, [
                'label' => 'Sorties auxquelles je ne suis pas inscrit',
                'required' => false,
            ])
            ->add('sortiesPassees', CheckboxType::class, [
                'label' => 'Sorties passées',
                'required' => false,
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchData::class,
            'method'=>'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
