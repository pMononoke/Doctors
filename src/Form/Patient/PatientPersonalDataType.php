<?php

namespace App\Form\Patient;

use App\Form\Patient\Dto\PatientPersonalDataDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientPersonalDataType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'label.patient.firstname',
            ])
            ->add('middleName', TextType::class, [
                'label' => 'label.patient.middlename',
            ])
            ->add('lastName', TextType::class, [
                'label' => 'label.patient.lastname',
            ])
            ->add('gender', ChoiceType::class, [
                'label' => 'label.patient.gender',
                'choices' => [
                    'label.patient.gender.unassigned' => null,
                    'label.patient.gender.male' => 'male',
                    'label.patient.gender.female' => 'female',
                ],
            ])
            ->add('dateOfBirth', DateType::class,
                [
                    'label' => 'label.patient.date_of_birth',
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
            'translation_domain' => 'messages',
        ]);
    }
}
