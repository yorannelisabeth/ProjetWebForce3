<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Regex;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      
        $builder
            ->add('pseudo')
            ->add('roles' ,ChoiceType::class,[
                "choices" =>[
                    "Admin" => "ROLE_ADMIN",
                    "Client" => "ROLE_CLIENT"
                ],
                "multiple" => true, //plusieur role
                "expanded" => true // cases à cocher
            ])
            ->add('password', TextType::class,[
                "mapped" => false, 
                "constraints" => [
                    new Regex([
                        "pattern" => "/^(?=.*[a-z])(?=.*\d)(?=.*{4,10})$/",
                        "message" => "Le mot de passe doit contenir au moins 1chiffre et doit faire entre 4 et 10 caractères "
                    ])

                    ],
                    "help"=> "Le mot de passe doit contenir au moins 1chiffre et doit faire entre 4 et 10 caractères ",
            ])
            ->add('adresse')
            ->add('prenom')
            ->add('nom')
            ->add('email')
            ->add('codePostal')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
