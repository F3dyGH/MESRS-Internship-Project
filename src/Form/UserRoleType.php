<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserRoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',EmailType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please insert email',
                    ]),
                ],
                'required' => true,
                'attr' => ['class' =>'form-control', 'disabled'],
                'disabled' => true,
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Admin' => 'ROLE_ADMIN',
                    'Student' => 'ROLE_STUD',
                    'Instructor' => 'ROLE_INST',
                ],
                'expanded' => true,
                'multiple' => true,
                'label' => 'Roles'
            ])
        ->add('Submit', SubmitType::class, [
            'attr' => ['class' => 'btn btn-primary']
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
