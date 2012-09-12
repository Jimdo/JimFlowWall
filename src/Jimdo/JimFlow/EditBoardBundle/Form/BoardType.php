<?php

namespace Jimdo\JimFlow\EditBoardBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class BoardType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                    'label' => 'Board Name'
                ))
            ->add('track', 'checkbox', array(
                    'label' => 'Track Board',
                    'required'  => false
            ))
            ->add('boardColumns', 'collection', array(
                                                     'type' => new BoardColumnType(),
                                                     'allow_add' => true,
                                                     'by_reference' => false,
                                                     'attr' => array(
                                                         'class' => 'boardColumns'
                                                     )
                                                )
            );
        ;
    }

    public function getName()
    {
        return 'jimdo_jimflow_editboardbundle_boardtype';
    }
}
