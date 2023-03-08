<?php

namespace App\Form;

use App\Entity\CompteBancaire;
use App\Entity\Transaction;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
class TransactionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('rib_des')
            ->add('rib_env')
            ->add('montant')
            ->add('CompteB', EntityType::class, [
                // looks for choices from this entity
                'class' => CompteBancaire::class,
                // uses the User.username property as the visible option string
                'choice_label' => 'rib',
                // used to render a select box, check boxes or radios
                'multiple' => false,
                'expanded' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Transaction::class,
        ]);
    }
}
