<?php
/**
 * Created by PhpStorm.
 * User: vlad
 * Date: 10.04.2016
 * Time: 14:36
 */

namespace UbbIssBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use UbbIssBundle\Entity\Activity;

class EvaluationAdmin extends Admin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('subject')
            ->add('student')
            ->add('sessionGrade', 'number')
            ->add('retakeSessionGrade', 'number');
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('subject')
            ->add('student')
            ->add('sessionGrade')
            ->add('retakeSessionGrade');
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('subject')
            ->addIdentifier('student')
            ->addIdentifier('sessionGrade')
            ->addIdentifier('retakeSessionGrade');
    }
}