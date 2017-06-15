<?php
namespace Home\FavorisBundle\Form;

use Home\FavorisBundle\Entity\Media;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MediaForm extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
$builder
    // ...
    ->add('file', FileType::class, array('label' => 'Add an image or a video','multiple'=>true))
    ->add('Valider',SubmitType::class, array(
            'attr'=>array('class'=>'btn btn-success')
        ))
    // ...
    ;
}

public function configureOptions(OptionsResolver $resolver)
{
$resolver->setDefaults(array(
'data_class' => Media::class,
));
}

}