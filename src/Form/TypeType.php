<?php

namespace App\Form;

use App\Entity\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class TypeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',ChoiceType::class, array(
                'choices' => array(
                    'Visa classique ' => 'Visa classique ',
                    'Visa Gold' => 'Visa Gold',
                    'visa world elite' => 'visa world elite'
                ),
                'expanded' => true,
                'multiple' => false,
            ))
            ->add('description', TextareaType::class,[
                'attr'=>[
                    'placeholder'=>'descriiption',

                    'class'=>'form-control'
                ]
            ])

            ->add('Ajout',SubmitType::class,[
                'attr'=>[

                    'class'=>'btn btn-primary'
                ]])



        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Type::class,
        ]);
    }
}
