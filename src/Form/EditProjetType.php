<?php

namespace App\Form;

use App\Entity\Admin;
use App\Entity\Projetsexam;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EditProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', TextType::class, [
            'attr' => [
                'class' => 'form_content_input'
            ],
            'label' => 'Nom du projet',
            'label_attr' => [
                'class' => 'form_content_label'
            ]
        ])
        ->add('imageFile', VichImageType::class, [
            'label' => "Image du site (1920*945)",
            'required' => false
        ])
        ->add('link', TextType::class, [
            'attr' => [
                'class' => 'form_content_input'
            ],
            'label' => 'Lien du site',
            'label_attr' => [
                'class' => 'form_content_label'
            ],
        ])
        ->add('github', TextType::class, [
            'attr' => [
                'class' => 'form_content_input'
            ],
            'label' => 'Lien du Github',
            'label_attr' => [
                'class' => 'form_content_label'
            ],
        ])
        ->add('Admin',  EntityType::class, [
            'class' => Admin::class,
            'choice_label' => 'email',
            'label' => 'Créateur',
            'placeholder' => '-- Choisir un utilisateur --',
        ])
        ->add('submit', SubmitType::class, [
            'attr' => [
                'class' => 'submit'
            ],
            'label' => 'Modifier'
        ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Projetsexam::class,
        ]);
    }
}
