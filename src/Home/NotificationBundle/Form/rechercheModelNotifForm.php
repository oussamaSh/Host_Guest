<?php
/**
 * Created by PhpStorm.
 * User: Sahbani
 * Date: 23/03/2017
 * Time: 16:23
 */

namespace Home\NotificationBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class rechercheModelNotifForm extends AbstractType
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
            ->add('Valider',SubmitType::class);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'home_entitybundle_modelnotif';
    }


}