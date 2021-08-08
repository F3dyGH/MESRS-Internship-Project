<?php

namespace App\Form;

use App\Entity\User;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('email')
            /*->add('roles', HiddenType::class,[
                'attr' => ['value'=>in_array('ROLE_STUD',$rolesTab, true)]
            ])*/
            //->add('password', HiddenType::class)
            ->add('name')
            ->add('lastname')
            ->add('username')
            ->add('about', TextareaType::class)
            ->add('image', HiddenType::class)
            ->add('description')
            ->add('imageFile', VichImageType::class,[
                'image_uri' => false,
                'allow_delete' => true,
                'delete_label' => 'Remove Avatar    ',
                'required' => false,
                'download_uri' => false,
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'required' => false,
                'first_options' => [
                    'attr' => ['placeholder' => 'New Password', 'class' => 'form-control'],
                    'constraints' => [
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Your password should be at least {{ limit }} characters',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ],
                    'label' => false,
                    'label_attr' => ['class' => 'col-form-label text-dark'],
//                    'required'=>false,
                ],
                'second_options' => [
                    'attr' => ['autocomplete' => 'new-password', 'placeholder' => 'Confirm Password', 'class' => 'form-control'],
                    'label' => false,
//                    'required'=>false,
                ],
                'invalid_message' => 'The password fields must match.',
                // Instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
