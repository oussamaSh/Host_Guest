<?php

namespace Home\EntityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LogementType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('titreAnnonce')->add('paysLogement')->add('adresseLogement')->add('descriptionLogement')->add('codePostal')->add('prixLogement')->add('nbrChambre')->add('nbrLit')->add('nbrSalledebain')->add('typeLogement')->add('parking')->add('checkin')->add('checkout')->add('reglementLogement')->add('region')->add('reservationExpress')->add('signalementAnnonce')->add('latlogement')->add('longlogement')->add('idMembre')->add('idAdmin')->add('image');
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
