<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 10.04.2016
 * Time: 14:56
 */

namespace UbbIssBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use UbbIssBundle\Entity\Activity;

class StudycontractAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('student')
            ->add('semester', 'text')
            ->add('subjects');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('student')
            ->add('semester')
            ->add('subjects');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('student')
            ->add('semester')
            ->add('subjects');
    }
}