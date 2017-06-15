<?php

namespace Home\AvisBundle\Form;
use blackknight467\StarRatingBundle\Form\RatingType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



class AvisType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('noteAvis', RatingType::class, [  'label' => 'Note Global ' ])
            ->add('proprete', RatingType::class, [  'label' => 'proprete' ])
            ->add('quaitePrix', RatingType::class, [  'label' => 'quaitePrix' ])
            ->add('accueil', RatingType::class, [  'label' => 'accueil' ])
            ->add('signalement', HiddenType::class, array(
                'data' => 0,
                ))
            ->add('descriptionAvis')
          //  ->add('idLogement',EntityType::class)
          /* ->add('idLogement',EntityType::class,array('class'=>"HomeEntityBundle:Avis","choice_label"=>"idLogement"))
            ->add('id_user',EntityType::class,array('class'=>"HomeUserBundle:User","choice_label"=>"id"))*/
            ->add('save',SubmitType::class);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Home\EntityBundle\Entity\Avis'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'home_entitybundle_avis';
    }


}
