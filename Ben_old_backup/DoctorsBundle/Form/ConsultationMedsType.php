<?php

namespace Ben\DoctorsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ConsultationMedsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('meds', 'entity', array('label'=>'Medicament', 'class' => 'BenDoctorsBundle:Meds','property' => 'name',))
            ->add('meds', 'entity', [
                'label' => 'Medicament',
                'class' => 'BenDoctorsBundle:Meds',
                'query_builder' => function (\Doctrine\ORM\EntityRepository $er) {
                    return $er->createQueryBuilder('m')
                        ->where('m.count > 0')
                        ->andWhere('m.expdate > CURRENT_DATE()')
                        ->orderBy('m.name', 'ASC');
                },
                ])
            ->add('count', 'text', ['label' => 'Nombre d\'unité'])
            ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Ben\DoctorsBundle\Entity\ConsultationMeds',
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ben_consultationmeds';
    }
}
