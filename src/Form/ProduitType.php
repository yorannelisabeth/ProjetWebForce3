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
use Symfony\Component\Validator\Constraints\Blank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class,[
                "label" => "Nom du produit",
                "required" => "false",
                "constraints" => [
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Your Product Name should be at least {{ limit }} characters',
                        'max' => 99,
                    ])
                    
                ]
                

            ])
            ->add('category', TextType::class,[
                "required" => "false",
                "label" => "Categorie",
                "constraints" => [
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Your Category Name should be at least {{ limit }} characters',
                        'max' => 99,
                    ])
                ]
            ])
            ->add('stock',IntegerType::class,[
                "label" => "Stock",
                "required" => true,
            ])
            ->add('prix', MoneyType::class,[
                "required" => true,
                "label" => "Prix",
            ] )
            ->add('photo', FileType::class,[
                "mapped" => false, 
            ])
            ->add('description', TextareaType::class,[
                "required" => "false",
                "label" => "Description",
                "constraints" => [
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Your description should be at least {{ limit }} characters',
                        'max' => 3000,
                    ])
                ]
            ])
            ->add('marque', TextType::class,[
                "required" => "false",
                "label" => "Marque",
                "constraints" => [
                    new NotBlank([
                        'message' => 'Please write a Brand'
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Your Brand should be at least {{ limit }} characters',
                        'max' => 100,
                    ])
                ]
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
