<?php
/**
 * Created by PhpStorm.
 * User: Sahbani
 * Date: 29/03/2017
 * Time: 16:39
 */

namespace Home\ReclamationBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class Recherchereclamationform extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('sujetReclamation',ChoiceType::class,array('choices'=>array(
            ''=>'','Livraison'=>'Livraison','Host'=>'Host','Guest'=>'Guest','Annonce'=>'Annonce'),
                'expanded'=>false,
                'multiple'=>false,
                'label'=>'Type'))
            ->add('etat',ChoiceType::class, array('choices'=>array(
                ''=>'','En cours'=>'En cours','Cloture'=>'Cloture'),
                'expanded'=>false,
                'multiple'=>false,
                'label'=>'Etat'))
            ->add('dateReclamation',DateType::class,array('label'=>'Date'))
            ->add('Rechercher',SubmitType::class);
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
        return 'home_entitybundle_reclamation';
    }

}