<?php

namespace Home\ReservationBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AjoutReservation extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dateDebut', DateType::class,  array(
            'widget' => 'single_text',
           'format' => 'yyyy-MM-dd',
            //'max' => date('Y-m-d')
            'data' =>  new \DateTime('now'),
           // 'disabled'=>true,

          // 'attr' => ['class' =>  '  datepicker-wrap ,ui-datepicker-trigger  '],

                    ))




            ->add('dateFin', DateType::class,  array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ) )



           // ->add('id_user',EntityType::class,array('class'=>"HomeUserBundle:User","choice_label"=>"id"))





            ->add('Reserver',SubmitType::class , array(
        'attr'=>array('class'=>'button yellow full-width uppercase btn-small')



        ));

    }



    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Home\EntityBundle\Entity\Reservation'
        ));
    }

    public function getName()
    {
        return 'home_reservation_bundle_ajout_reservation';
    }


}
