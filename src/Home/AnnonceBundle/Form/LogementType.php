<?php

namespace Home\AnnonceBundle\Form;


use Home\EntityBundle\Entity\Equipement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class LogementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titreAnnonce')
                ->add('paysLogement',CountryType::class,array('multiple'=>false))
        ->add('adresseLogement')
                ->add('descriptionLogement')
                ->add('codePostal')
                ->add('prixLogement')
                ->add('nbrChambre',ChoiceType::class, array(
                    'choices'  => array(
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4',
                        '5' => '5',
                    ),
                ))
            ->add('nbrLit',ChoiceType::class, array(
                'choices'  => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                ),
            ))
            ->add('nbrSalledebain',ChoiceType::class, array(
                'choices'  => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                ),
            ))
                ->add('typeLogement',ChoiceType::class, array(
                    'choices'  => array(
                        'Maison' => 'Maison',
                        'Appartement' => 'Appartement',
                        'Studio' => 'Studio',
                    ),
                ))
                ->add('parking')
                ->add('checkin')
                ->add('checkout')
                ->add('reglementLogement')
                ->add('region')
                ->add('reservationExpress', HiddenType::class, array(
                'data' => true,
            ))
               /* ->add('signalementAnnonce')
                ->add('latlogement')
                ->add('longlogement')*/
               // ->add('image',ImageType::class)

              //  ->add('idMembre',EntityType::class,
                //    array('class'=>"HomeUserBundle:User","choice_label"=>"id"))
        /*    ->add('equipements', ChoiceType::class, [
                'choices' => [
                    new Equipement(1),
                    new Equipement(2),
                    new Equipement(3),
                    new Equipement(4),
                ],
            'expanded' => true,
                'multiple' => true,
                'mapped' => false
           ])*/
        ->add('SUIVANT',SubmitType::class);


    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Home\EntityBundle\Entity\Logement'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'home_entitybundle_logement';
    }


}
