<?php

namespace App\Form\Patient;

use App\Dto\PatientPersonalDataDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientPersonalDataFormDTOType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('middleName')
            ->add('lastName')
            ->add('gender', ChoiceType::class, [
                'choices' => [
                    'Unassigned' => null,
                    'Male' => 'male',
                    'Female' => 'female',
                ],
            ])
            ->add('dateOfBirth', DateType::class,
                [
                    'required' => true,
                    'input' => 'datetime_immutable',
                    'years' => range(date('Y'), 1900, 1),
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PatientPersonalDataDTO::class,
        ]);
    }
}
