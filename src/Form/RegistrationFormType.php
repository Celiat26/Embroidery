<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email',EmailType::class,[
               'required' => false,
               'label' => 'Email',
               'attr' => [
                        'placeholder' => 'exemple@exemple.com'
                    ]
               ])
            ->add('name',TextType::class,[
                   'required' => false,
                   'label'=> 'Votre nom',
                   'attr' => [
                       'placeholder' => 'John Doe'
                   ]
               ])
            ->add('pseudo',TextType::class,[
                'required' => false,
                'label' => 'Pseudo',
                'attr' => [
                    'placeholder' => 'Pseudo'
                ]
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label'=> 'Mot de passe',
                'required' => false,
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le mot de passe est requis',
                    ]),
                   
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
