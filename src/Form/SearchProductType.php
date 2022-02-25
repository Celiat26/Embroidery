<?php

namespace App\Form;

use App\Entity\Category;
use App\Search\SearchProduct;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('filterByName',TextType::class,[
                'label' => 'Filtrer par nom',
                'required' => false,
            ])
            ->add('filterByCategory',EntityType::class,[
                'label' => 'Filtrer par catégorie',
                'placeholder' => '-- Choisir --',
                'class' => Category::class,
                'required' => false,
                'choice_label' => 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SearchProduct::class,
            'method' => 'get',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}