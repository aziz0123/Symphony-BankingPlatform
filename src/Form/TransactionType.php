<?php

namespace App\Form;

use App\Entity\Account;
use App\Entity\Compte;
use App\Entity\Transaction;
use Gregwar\CaptchaBundle\Type\CaptchaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransactionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('captcha', CaptchaType::class)
            ->add('sourceAccount', EntityType::class, [
                'class' =>
                Compte::class,
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('destinationAccount', NumberType::class)
            ->add('amount', NumberType::class, [
                'attr' => [
                    'placeholder' => "votre montant a tranferer",
                    'class' => 'form-control'
                ]
            ])

            ->add('Transferer', SubmitType::class, [
                'attr' => [

                    'class' => 'btn btn-primary'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Transaction::class,
        ]);
    }
}
