<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 18/05/2017
 * Time: 01:22
 */

namespace Home\FavorisBundle\Form;
use Home\FavorisBundle\Entity\Album;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class AlbumForm
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
            'data_class' => Album::class,
        ));
    }
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'home_favorisbundle_album';
    }
    public function getName()
    {
        return 'file';
    }
}