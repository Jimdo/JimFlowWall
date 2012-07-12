<?php

namespace Jimdo\JimKanWall\EditBoardBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class BoardColumnType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name')
                ->add('ordering', 'hidden')
        ;
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'Jimdo\JimKanWall\ImportBundle\Entity\BoardColumn',
        );
    }

    public function getName()
    {
        return  'jimdo_jimkanwall_editboardbundle_boardcolumntype';
    }
}