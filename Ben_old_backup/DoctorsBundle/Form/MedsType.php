<?php

namespace Ben\DoctorsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MedsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', ['label' => 'Medicament'])
            ->add('count', 'text', ['label' => 'Nombre d\'unité'])
            ->add('type', 'text', ['label' => 'Type'])
            ->add('about', 'textarea', ['label' => 'Description'])
            ->add('expdate', 'date', ['widget' => 'single_text', 'label' => 'Date d\'expiration'])
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Ben\DoctorsBundle\Entity\Meds',
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ben_meds';
    }
}
