<?php

namespace Home\ReclamationBundle\Form;

use Home\EntityBundle\Entity\Message;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReclamationType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('dateReclamation',DateType::class, array(
            'data' => new \DateTime('now'),'label'=>'Date'))
            ->add('sujetReclamation',ChoiceType::class,array('choices'=>array(
                'Livraison'=>'Livraison','Host'=>'Host','Guest'=>'Guest','Annonce'=>'Annonce'),
            'expanded'=>false,
            'multiple'=>false,
            'label'=>'Type'))
            ->add('etat',HiddenType::class, array('data' => 'En cours'))
            ->add('idMembre',EntityType::class,array('class'=>"HomeEntityBundle:User","choice_label"=>"id"))
            ->add('Valider',SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Home\EntityBundle\Entity\Reclamation'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'home_entitybundle_reclamation';
    }


}