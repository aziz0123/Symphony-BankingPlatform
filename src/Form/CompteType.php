<?php

namespace App\Form;

use App\Entity\Compte;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Gregwar\CaptchaBundle\Type\CaptchaType;


class CompteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            ->add('name',TextType::class,[
                'attr'=>[
                    'placeholder'=>"votre nom",
                    'class'=>'form-control'
                ]
            ])
            ->add('etat', ChoiceType::class, array(
                'choices' => array(
                    'non active' => 'non active',
                    'active' => 'active',
                ),
                'expanded' => true,
                'multiple' => false,
            ))
            ->add('numeroCompte',NumberType::class,[
                'attr'=>[
                    'placeholder'=>"votre numero",
                    'class'=>'form-control'
                ]
            ])
            ->add('rib',NumberType::class,[
                'attr'=>[
                    'placeholder'=>"votre RIB",
                    'class'=>'form-control'
                ]
            ])
            ->add('balance',NumberType::class,[
                'attr'=>[
                    'placeholder'=>"votre Montant",
                    'class'=>'form-control'
                ]
            ])
            ->add('Ajouter',SubmitType::class,[
                'attr'=>[

                    'class'=>'btn btn-primary'
                ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Compte::class,
        ]);
    }
}
