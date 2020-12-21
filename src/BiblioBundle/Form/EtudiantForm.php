<?php
namespace BiblioBundle\Form;



use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class EtudiantForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder,array $options)
    {
        $builder
            ->add('firstName', TextareaType::class)
            ->add('lastName', TextareaType::class)
            ->add('email',TextareaType::class)
            ->add('password', TextareaType::class) ;
    }
    public function getName()
    {
        return 'Etudiant';
    }
}