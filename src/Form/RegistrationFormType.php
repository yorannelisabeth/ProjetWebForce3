<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("pseudo", TextType::class,[
                "label" => "Pseudo",
                "required" => "false",
                "constraints" => [
                    new NotBlank([
                        'message' => 'Please enter a Nickname',
                    ]),
                    new Length([
                        'min' => 4,
                        'minMessage' => 'Your Nickname should be at least {{ limit }} characters',
                        'max' => 4096,
                    ]),
                ],

            ])
            
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 4,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add("prenom" , TextType::class,[
                "label" => "Prénom",
                "required" => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your surname',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Your surname should be at least {{ limit }} characters',
                        'max' => 4096,
                    ]),
                    new Regex([
                        'pattern' => '/\d/',
                        'match' => false,
                        'message' => 'Your surname cannot contain a number',
                    ])
                ]


            ])
            ->add("nom" , TextType::class,[
                "label" => "Nom",
                "required" => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your firstname',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Your firstname should be at least {{ limit }} characters',
                        'max' => 4096,
                    ]),
                    new Regex([
                        'pattern' => '/\d/',
                        'match' => false,
                        'message' => 'Your firstname cannot contain a number',
                    ])
                ]

            ])
            ->add("adresse" , TextType::class,[
                "label" => "Adresse",
                "required" => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your adress',
                    ]),
                    new Length([
                        'min' => 5,
                        'minMessage' => 'Your adress should contain at least {{ limit }} characters/numbers',
                        'max' => 100,
                    ]),
                ]

            ])
            ->add("email" , TextType::class,[
                "label" => "Email",
                "required" => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your mail box',
                    ]),
                    new Email([
                        'message' => 'The email "{{ value }}" is not a valid email.',
                    ]),
                ]
                

            ])
            ->add("code_postal" , TextType::class,[
                "label" => "Code_postal",
                "required" => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a postal code',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Your postal code should be at least {{ limit }} numbers',
                        'max' => 10,
                    ]),
                    
                ]

            ])
            ->add('roles' ,ChoiceType::class,[
                "choices" =>[
                    
                    "Client" => "ROLE_CLIENT"
                ],
                "multiple" => true, //plusieur role
                "expanded" => true // cases à cocher
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
