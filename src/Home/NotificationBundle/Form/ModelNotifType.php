<?php

namespace Home\NotificationBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModelNotifType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
            $builder->add('typeNotif',ChoiceType::class,array('choices'=>array(
                'Livraison'=>'Livraison','Badge'=>'Badge','Compte'=>'Compte','Reclamtion'=>'Reclamation'),
                'expanded'=>false,
                'multiple'=>false,
                'label'=>'Type'
                ))
                ->add('contenuNotif',TextType::class,array('label'=>'Contenu '))
            ->add('Valider',SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Home\EntityBundle\Entity\ModelNotif'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'home_entitybundle_modelnotif';
    }


}
