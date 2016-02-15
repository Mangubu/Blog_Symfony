<?php

namespace BlogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class PostType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
    ->add('title', TextType::class)
    ->add('content', TextareaType::class)
    ->add('tags', TextType::class)


    ->add('category', 'entity', array('class' => 'BlogBundle:Category', 'property' => 'name'))
    ->add('publicationDate', DateType::class, ['required' => false, 'format' => 'yyyy-MM-dd', 'widget' => 'single_text'])
    ->add('submit', SubmitType::class, array(
        'label' => 'ADD',
        'attr'   =>  array(
        'class'   => 'red darken-1')
    ));
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'BlogBundle\Entity\Post',
    ));
  }
}
