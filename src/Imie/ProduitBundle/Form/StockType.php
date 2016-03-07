<?php

namespace Imie\ProduitBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StockType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    /*public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('qtestock')
            ->add('qtedefectueux')
            ->add('dateachat', 'date')
            ->add('idutilisateur')
            ->add('idfournisseur')
            ->add('idtaille')
            ->add('idcouleur')
            ->add('idproduit')
        ;
    }
   */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /*
            ->add('idproduit', 'entity', array(
            'class' => 'ImieProduitBundle:Produit',
            'placeholder' => 'Choisissez un produit',
            'label' => 'Produit',
            'property' => 'id',
            ))         */
        //            ->add('idutilisateur', 'entity', array('class' => 'ImieProduitBundle:Utilisateur','label' => 'Utilisateur',))
        $builder
            ->add('idproduit', 'entity' , array('class' => 'ImieProduitBundle:Produit','label' => 'Choisir un produit:', 'required'=>true, 'max_length'=>450))
            ->add('qtestock', 'text', array('label' => 'Quantité en stock', ))
            ->add('qtedefectueux', 'text', array('label' => 'Quantité de stock défectueux',))
            //->add('dateachat')
            ->add('idfournisseur','entity', array('class' => 'ImieProduitBundle:Fournisseur','label' => 'Fournisseur',))
            ->add('idtaille','entity', array('class' => 'ImieProduitBundle:Taille','label' => 'Taille',))
            ->add('idcouleur', 'entity', array('class' => 'ImieProduitBundle:Couleur','label' => 'Couleur',))
            
        ;
    }
    
    
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Imie\ProduitBundle\Entity\Stock'
        ));
    }
}
