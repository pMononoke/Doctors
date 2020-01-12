<?php

namespace Ben\DoctorsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TestType extends AbstractType
{
    private $general;

    public function __construct($general = false)
    {
        $this->general = $general;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('consultation');

        if ($this->general) {
            $builder
                ->add('taille', 'text', ['label' => 'Taille'])
                ->add('poids', 'text', ['label' => 'Poids'])
                ->add('ta', 'text', ['label' => 'TA'])
                ->add('od', 'text', ['label' => 'OD'])
                ->add('og', 'text', ['label' => 'OG'])
                ->add('hasvisualissue', 'checkbox', ['label' => 'Trouble visuel', 'required' => false])
                ->add('fixedvisualissue', 'choice', ['choices' => ['Corrigé' => 'Corrigé', 'Non corrigé' => 'Non corrigé'],
                        'expanded' => true,
                        'multiple' => false,
                        'label' => false,
                        ])
                ;
        } else {
            $builder
                ->add('type', 'choice', ['label' => 'Type', 'choices' => [
                    'Examens biologiques' => 'Examens biologiques',
                    'Examens radioloqiue' => 'Examens radioloqiue',
                    'Autre' => 'Autre', ]])
                ->add('request', 'textarea', ['label' => 'Demande', 'required' => false])
                ->add('result', 'textarea', ['label' => 'Resultat', 'required' => false])
                ;
        }
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Ben\DoctorsBundle\Entity\Test',
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ben_test';
    }
}
