<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 10.04.2016
 * Time: 14:44
 */

namespace UbbIssBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use UbbIssBundle\Entity\Activity;

class StudentAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name', 'text')
            ->add('specialization')
            ->add('studyline')
            ->add('group')
            ->add('email', 'email')
            ->add('address', 'text')
            ->add('phoneNumber');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('specialization')
            ->add('studyline')
            ->add('group')
            ->add('email')
            ->add('address')
            ->add('phoneNumber');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('name')
            ->addIdentifier('specialization')
            ->addIdentifier('studyline')
            ->addIdentifier('group')
            ->addIdentifier('email')
            ->addIdentifier('address')
            ->addIdentifier('phoneNumber');
    }
}