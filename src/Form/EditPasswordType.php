<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class EditPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('currentPassword',PasswordType::class,[
            'label' => 'Mot de passe actuel',
            'required' => false,
            'constraints' => [
                new NotBlank([
                    'message' => 'Le mot de passe actuel est requis',
                ]),
                new UserPassword([
                    'message' => 'Mot de passe actuel erroné'
                ])
            ]
        ])
        ->add('plainPassword', RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => 'Les mots de passe doivent correspondre.',
            // instead of being set onto the object directly,
            // this is read and encoded in the controller
            'mapped' => false,
            'required' => false,
            'attr' => ['autocomplete' => 'new-password'],
            'first_options'  => [
                'label' => 'Mot de passe',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le mot de passe est requis',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Le mot de passe doit faire au moins {{ limit }} caractères.',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ],
            'second_options' => [
                'label' => 'Confirmer votre mot de passe',
                'constraints' => [
                    new NotBlank([
                        'message' => 'La confirmation du mot de passe est requise',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Le mot de passe doit faire au moins {{ limit }} caractères.',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ],
           
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}