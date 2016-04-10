<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 09.04.2016
 * Time: 17:24
 */

namespace UbbIssBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use UbbIssBundle\Entity\Activity;

class ActivityAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('teacher')
            ->add('subject')
            ->add('type', 'choice', array('choices' => Activity::getTypes(), 'expanded' => true))
            ->add('hoursPerWeek', 'number');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('teacher')
            ->add('subject')
            ->add('type')
            ->add('hoursPerWeek');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('teacher')
            ->addIdentifier('subject')
            ->addIdentifier('type')
            ->addIdentifier('hoursPerWeek');
    }
}