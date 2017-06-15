<?php

namespace Home\ReservationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ReservationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('etat', ChoiceType::class,array('choices'=>array('Confirmé'=>'Confirmé', 'En attente de confirmation'=>'En attente de confirmation' , 'Annulé'=>'Annulé'),
            'expanded'=>false,
            'multiple'=>false,
            'label'=>'Etat de la réservation:'
            ))

            ->add('Rechercher',SubmitType::class    , array(
                'attr'=>array('class'=>'btn btn-success '))
            );
    }




    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Home\EntityBundle\Entity\Reservation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'home_entitybundle_reservation';
    }


}
