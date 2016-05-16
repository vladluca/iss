<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 09.04.2016
 * Time: 17:13
 */

namespace UbbIssBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class SubjectAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text')
            ->add('specialization')
            ->add('studyline')
            ->add('credits', 'number')
            ->add('semester', 'number');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('specialization')
            ->add('studyline')
            ->add('credits')
            ->add('semester')
            ->add('name');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->addIdentifier('specialization')
            ->addIdentifier('studyline')
            ->addIdentifier('credits')
            ->addIdentifier('semester');
    }
}