<?php

namespace Home\AvisBundle\Form;

use blackknight467\StarRatingBundle\Form\RatingType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AvishostType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('acceuilHost', RatingType::class, [  'label' => 'Acceuil du Host' ])
            ->add('reactiviteHost', RatingType::class, [  'label' => 'Reactivite du Host' ])
            ->add('descriptionAvis')
            ->add('signalement', HiddenType::class, array(
                'data' => 0,))
         //   ->add('idMembre',EntityType::class,array('class'=>"HomeUserBundle:User","choice_label"=>"id"))
            ->add('save',SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Home\EntityBundle\Entity\Avishost'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'home_entitybundle_avishost';
    }


}
