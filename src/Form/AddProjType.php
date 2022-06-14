<?php

namespace App\Form;

use App\Entity\Admin;
use App\Entity\Projetsexam;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class AddProjType extends AbstractType
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
                'label' => "Image du site (1920*945)"
                ])
            ->add('link', TextType::class, [
                'attr' => [
                    'class' => 'form_content_input'
                ],
                'label' => 'Lien du site',
                'label_attr' => [
                    'class' => 'form_content_label'
                ],
                'data' => "#",
                'required' => false
            ])
            ->add('github', TextType::class, [
                'attr' => [
                    'class' => 'form_content_input'
                ],
                'label' => 'Lien du Github',
                'label_attr' => [
                    'class' => 'form_content_label'
                ],
                'data' => "#",
                'required' => false
            ])
            ->add('Admin',  EntityType::class, [
                'class' => Admin::class,
                'choice_label' => 'email',
                'label' => 'Créateur',
                'placeholder' => '-- Choisir un utilisateur --'
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'submit'
                ],
                'label' => 'Ajouter'
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
