<?php

namespace App\Form;

use App\Entity\Admin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class AddUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => [
                    'class' => 'form_content_input'
                ],
                'label' => 'Nom',
                'label_attr' => [
                    'class' => 'form_content_label'
                ]
            ])
            ->add('prenom', TextType::class, [
                'attr' => [
                    'class' => 'form_content_input'
                ],
                'label' => 'Prénom',
                'label_attr' => [
                    'class' => 'form_content_label'
                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form_content_input'
                ],
                'label' => 'Addresse mail',
                'label_attr' => [
                    'class' => 'form_content_label'
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => "Mot de passe",
                ],
                'second_options' => [
                    'label' => "Confirmation du mot de passe"
                ],
                'invalid_message' => "Les mots de passe ne  correspondent pas"
            ])
            ->add('photo', TextType::class, [
                'label' => "Image de profil (user.png par défaut)",
                'data' => "user.png"
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'submit'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Admin::class,
        ]);
    }
}
