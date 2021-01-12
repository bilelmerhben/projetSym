<?php

namespace BiblioBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title',TextareaType::class)
            ->add('author',TextareaType::class)
            ->add('summary',TextareaType::class)
            ->add('publication',DateType::class)
            ->add('availability',RadioType::class)
            ->add('emprunterPar', EntityType::class, array(
                'class'=> 'BiblioBundle\Entity\Etudiant',
                'choice_label'=>'firstName',
                'expanded'=>false,
                'multiple'=>false

            ));

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BiblioBundle\Entity\Book'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bibliobundle_book';
    }


}
