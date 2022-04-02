<?php

namespace App\Form;

use App\Entity\InstForm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class InstformType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('speciality')
            ->add('cv',HiddenType::class)
            ->add('cvFile',VichFileType::class,[
        'required' => true,
        'download_uri' => false,
    ])
            ->add('date',HiddenType::class)
            ->add('updatedAt',HiddenType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            // important part; unique key
            'intention'       => 'form_intention',
            'data_class' => InstForm::class,
        ]);
    }
}
