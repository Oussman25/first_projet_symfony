<?php

namespace App\Form;

use App\Entity\Shoes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type as Type;
use Symfony\Component\Validator\Constraints as Assert;

class ShoesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name', Type\TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '2',
                    'maxlength' => '50'
                ],
                'label' => 'Nom',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank([
                        'message' => 'Ce champ ne peut pas être vide.',
                    ]),
                    new Assert\Length([
                        'min' => 2,
                        'max' => 50,
                        'minMessage' => 'Votre prénom doit contenir au moins {{ limit }} caractères.',
                        'maxMessage' => 'Votre prénom ne peut pas contenir plus de {{ limit }} caractères.',
                    ]),
                ]
            ])
            ->add('Price', Type\MoneyType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Prix',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank([
                      'message' => 'Ce champ ne peut pas être vide.',
                    ]),
                    new Assert\Positive([
                      'message' => 'Ce champ ne peut être négatif.',
                    ]),
                ]
            ])
            ->add('Image', Type\UrlType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Image',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\NotBlank([
                     'message' => 'Ce champ ne peut pas être vide.',
                    ]),
                    new Assert\Url([
                     'message' => 'Ce champ doit être une URL valide.',
                    ]),
                ]
            ])
            ->add('Submit', Type\SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4',
                ],
                'label' => 'Valider',
            ]);
            // ->add('SaleDate', Type\DateType::class, [
            //     'attr' => [
            //         'class' => 'form-control',
            //     ],
            //     'label' => 'Date de vente',
            //     'label_attr' => [
            //         'class' => 'form-label mt-4'
            //     ],
            //     'constraints' => [
            //         new Assert\NotNull([
            //         'message' => 'Ce champ ne peut pas être vide.',
            //         ]),
            //         new Assert\DateTime([
            //         'message' => 'Ce champ doit être une date valide.',
            //         ]),
            //     ]
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Shoes::class,
        ]);
    }
}
