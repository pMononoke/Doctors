<?php

namespace Ben\DoctorsBundle\Form;

use Ben\DoctorsBundle\Entity\Consultation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ConsultationType extends AbstractType
{
    private $general;

    public function __construct($type)
    {
        $this->general = ($type === Consultation::$GENERAL);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($this->general) {
            $builder
                ->add('motiftype', 'choice', ['label' => 'Type', 'choices' => ['EXAMEN MEDICAL SYSTEMATIQUE' => 'EXAMEN MEDICAL SYSTEMATIQUE', 'CONSULTATION MEDICALE A LA DEMANDE' => 'CONSULTATION MEDICALE A LA DEMANDE'],
                    'required' => false, ])
                ->add('name', 'text', ['label' => 'Motif']);
        } else {
            $builder
                ->add('name', 'text', ['label' => 'Specialité medicale'])
                ->add('infrastructure', 'text', ['label' => 'Infrastructure sanitaire de reference']);
        }

        $builder
            ->add('diagnosis')
            ->add('treatment', 'textarea', ['label' => 'Traitement préscrit', 'required' => false])
            ->add('person')
            ->add('type', 'hidden');

        if ($this->general) {
            $builder
                ->add('decision', 'choice', ['label' => 'Décision prise', 'choices' => [
                            'Préscription du traitement' => 'Préscription du traitement',
                            'Orientation vers la consultation médicale spécialisé' => 'Orientation vers la consultation médicale spécialisé', ],
                    'required' => false, ])
                ->add('chronic', 'checkbox', ['label' => 'Maladie chronique ?', 'required' => false]);
        }

        $builder->add('consultationmeds', 'collection', ['label' => 'Medicaments déliverés par le centre', 'type' => new ConsultationMedsType(), 'allow_add' => true, 'by_reference' => false, 'allow_delete' => true, 'prototype' => true])
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Ben\DoctorsBundle\Entity\Consultation',
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ben_consultation';
    }
}
