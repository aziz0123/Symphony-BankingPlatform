<?php

namespace App\Form;

use App\Entity\CarteBancaire;
use App\Entity\Compte;
use App\Entity\Type;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\TextType;



class CarteBancaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('nom',TextType::class,[
                'attr'=>[
                    'placeholder'=>"votre nom",
                    'class'=>'form-control'
                ]
            ])

            ->add('numCarte',NumberType::class,[
                'attr'=>[
                    'placeholder'=>"votre Num Carte",
                    'class'=>'form-control'
                ]
            ])
            ->add('cvv',NumberType::class,[
        'attr'=>[
            'placeholder'=>"votre cvv",
            'class'=>'form-control'
        ]
    ])
            ->add('email',EmailType::class,[
                'attr'=>[
                    'placeholder'=>"votre email",
                    'class'=>'form-control'
                ]
            ])

            ->add('idType',EntityType::class,
                ['class'=>
                    Type::class,
                    'choice_label'=> 'nom',
                    'multiple'=> false,
                    'expanded'=> true,
                ])
            ->add('compte',EntityType::class,
                ['class'=>
                    Compte::class, 
                    'choice_label'=> 'name',
                    'multiple'=> false,
                    'expanded'=> true,
                ])
                ->add('DateExp',DateType::class,[
                    'attr'=>[
                        'class'=>'form-control'
                    ]
                ])
                ->add('etat', ChoiceType::class, array(
                    'choices' => array(
                        'blocage' => 'blocage',
                        'activation' => 'activation',
                    ),
                    'expanded' => true,
                    'multiple' => false,
                ))
            ->add('Ajout',SubmitType::class,[
                'attr'=>[

                    'class'=>'btn btn-primary'
                ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CarteBancaire::class,
        ]);
    }
}
