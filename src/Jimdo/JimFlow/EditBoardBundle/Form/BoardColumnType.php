<?php

namespace Jimdo\JimFlow\EditBoardBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class BoardColumnType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name', 'text', array(
                        'label' => 'Column Name',
                        'attr' => array(
                            'class' => 'boardColumn'
                        )
                ))
                ->add('ordering', 'hidden')
        ;
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Jimdo\JimFlow\ImportBundle\Entity\BoardColumn',
        );
    }

    public function getName()
    {
        return  'jimdo_jimflow_editboardbundle_boardcolumntype';
    }
}