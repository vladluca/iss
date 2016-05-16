<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 10.04.2016
 * Time: 15:07
 */

namespace UbbIssBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use UbbIssBundle\Entity\Activity;

class UserAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('student')
            ->add('teacher')
            ->add('username')
            ->add('password', 'password');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('student')
            ->add('teacher')
            ->add('username');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('student')
            ->addIdentifier('teacher')
            ->addIdentifier('username');
    }
}