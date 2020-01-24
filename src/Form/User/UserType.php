<?php

namespace App\Form\User;

use App\Form\User\Dto\UserDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', TextType::class, [
                'label' => 'label.user.email',
            ])
            ->add('firstName', TextType::class, [
                'label' => 'label.user.first_name',
            ])
            ->add('lastName', TextType::class, [
                'label' => 'label.user.last_name',
            ])
            //->add('roles')
            //->add('password')
            ->add('accountStatus', ChoiceType::class, [
                //'label' => 'label.user.email',
                'label' => 'label.user.account_status',
                'required' => true,
                'choices' => [
                    'label.user.account_status.enable' => true,
                    'label.user.account_status.disabled' => false,
                ],
                'placeholder' => 'placeholder.user.account_status.unassigned',
            ])
        ;
    }

    /**
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserDTO::class,
            'translation_domain' => 'messages',
        ]);
    }
}
