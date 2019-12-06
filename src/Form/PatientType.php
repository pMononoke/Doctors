<?php

namespace App\Form;

use App\Dto\PatientDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('dateOfBirthday')
            ->add('cin')
            ->add('cne')
            ->add('email')
            ->add('birthday')
            ->add('birthcity')
            ->add('gender')
            ->add('contry')
            ->add('city')
            ->add('address')
            ->add('etablissement')
            ->add('university')
            ->add('gsm')
            ->add('cnss')
            ->add('cnsstype')
            ->add('parentName')
            ->add('parentAddress')
            ->add('parentGsm')
            ->add('parentFixe')
            ->add('ishandicap')
            ->add('handicap')
            ->add('needs')
            ->add('resident')
            ->add('created')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PatientDTO::class,
        ]);
    }
}
