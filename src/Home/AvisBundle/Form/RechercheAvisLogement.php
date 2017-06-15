<?php

namespace Home\AvisBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheAvisLogement extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
$builder-> add('idAvis')->add('save',SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getName()
    {
        return 'home_avis_bundle_recherche_avis_logement';
    }
}
