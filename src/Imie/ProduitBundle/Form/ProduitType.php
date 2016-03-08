<?php

namespace Imie\ProduitBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Imie\ProduitBundle\Form\ImageType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


class ProduitType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('description',TextareaType::class)
            ->add('prix')
            ->add('idcategorie','entity', array('class'=>'ImieProduitBundle:Categorie','label'=>'Sélectionnez une catégorie'))            
            ->add('idimage', new ImageType(), array('label'=>'Sélectionnez une image')) // Ajout du formulaire
            ->getForm();
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Imie\ProduitBundle\Entity\Produit'
        ));
    }
}
