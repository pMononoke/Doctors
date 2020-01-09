<?php

namespace App\Form\User;

use App\Form\User\Dto\UserDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', null, [
                'label' => 'label.user.email',
            ])
            //->add('roles')
            //->add('password')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserDTO::class,
            'translation_domain' => 'messages',
        ]);
    }
}
