<?php

namespace Ben\DoctorsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MetadataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('thekey', 'text', ['label' => 'Attribut'])
            ->add('thevalue', 'textarea', ['label' => 'Valeur'])
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Ben\DoctorsBundle\Entity\Metadata',
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ben_metadata';
    }
}
