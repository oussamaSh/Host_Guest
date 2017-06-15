<?php

namespace Home\ReservationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheFacture extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('etat', ChoiceType::class,array('choices'=>array('Payée'=>'Payée', 'Non payée'=>'Non payée'),
            'expanded'=>false,
            'multiple'=>false,
            'label'=>'Etat de la facture:'
        ))

            ->add('Rechercher',SubmitType::class   , array(
                    'attr'=>array('class'=>'btn btn-outline btn-success'))
            );


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Home\EntityBundle\Entity\Facture'
        ));
    }

    public function getName()
    {
        return 'home_reservation_bundle_recherche_facture';
    }
}
