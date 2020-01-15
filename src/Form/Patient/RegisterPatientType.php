<?php

namespace App\Form\Patient;

use App\Form\Patient\Dto\RegisterPatientDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterPatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('patientPersonalData', PatientPersonalDataType::class, [
                'label' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RegisterPatientDTO::class,
            'translation_domain' => 'messages',
        ]);
    }
}
