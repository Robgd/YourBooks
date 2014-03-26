<?php

namespace YourBooks\MainBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class EspacePresseAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', null, array('label' => 'Titre : '))
            ->add('content', null, array('label' => 'Contenu : '))
            ->add('url', null, array('label' => 'Vidéo (URL) : ', 'required' => false))
            ->add('image', 'file', array('label'=> 'Image : ', 'required' => false))
            ->add('file', 'file', array('label' => 'Fichier PDF : ', 'required' => false))
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title', null, array('label' => 'Titre : '))
            ->add('content', null, array('label' => 'Contenu : '))
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('title', null, array('label' => 'Titre : '))
            ->add('content', null, array('label' => 'Contenu : '))
            ->add('url', null, array('label' => 'Vidéo Youtube (ID) : '))
        ;
    }
}