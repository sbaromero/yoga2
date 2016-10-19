<?php

namespace EFP\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',TextType::class)
            ->add('firstName',TextType::class)
            ->add('lastName',TextType::class)
            ->add('dni', TextType::class)
            ->add('direccion', TextType::class)
            ->add('ciudad', TextType::class)
            ->add('provincia', TextType::class)
            ->add('cp', TextType::class)
            ->add('telfijo', TextType::class)
            ->add('telmovil', TextType::class)
            ->add('email', EmailType::class)
            ->add('fechnac', TextType::class)
            ->add('feching', TextType::class)
            ->add('fechreing', TextType::class)
            ->add('tipoalumno', ChoiceType::class, array('choices' => array('Clases' => 'CLASES_YOGA', 'Instructorado' => 'INSTRUCTORADO','Profesorado' => 'PROFESORADO', 'Posgrado' => 'POSGRADO','Curso' => 'CURSO_NATURISTA' ), 'placeholder' => 'Elija tipo de Alumno'))
            ->add('password', PasswordType::class)
            ->add('role', ChoiceType::class, array('choices' => array('Administrator' => 'ROLE_ADMIN', 'User' => 'ROLE_USER' ), 'placeholder' => 'Select a role'))
            ->add('isActive', CheckboxType::class)
            ->add('save', SubmitType::class)
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EFP\UserBundle\Entity\User'
        ));
    }
    
 
}
