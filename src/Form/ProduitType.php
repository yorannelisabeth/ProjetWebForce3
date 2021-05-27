<?php

namespace App\Form;

use App\Entity\Produit;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom', TextType::class,[
                "label" => "Nom du produit",
                "required" => true,

            ])
            ->add('Category', TextType::class,[
                "required" => true,
                "label" => "Categorie",
            ])
            ->add('Stock',IntegerType::class,[
                "label" => "stock",
                "required" => true,
            ])
            ->add('Prix', MoneyType::class,[
                "required" => true,
                "label" => "Prix",
            ] )
            ->add('Photo', FileType::class,[
                "mapped" => false,
                
            ])
            ->add('Description', TextareaType::class,[
                "required" => true,
                "label" => "Description",
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
