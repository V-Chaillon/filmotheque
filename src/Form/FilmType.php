<?php

namespace App\Form;

use App\Entity\Film;
use App\Entity\Personnage;
use App\Repository\PersonnageRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('resume')
            ->add('dateSortie', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('personnages', EntityType::class, [
                'class' => Personnage::class,
                'query_builder' => function (PersonnageRepository $pr) {
                    return $pr->createQueryBuilder('p')
                        ->orderBy('p.nom', 'ASC');
                },
                'choice_label' => 'nom',
                'multiple' => true
            ])

            ->getForm();

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Film::class,
            'csrf_protection' => false,
        ]);
    }
}