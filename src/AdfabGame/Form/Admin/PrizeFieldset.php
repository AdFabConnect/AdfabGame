<?php

namespace AdfabGame\Form\Admin;

use AdfabGame\Entity\Prize;
use Zend\Form\Fieldset;
use Zend\Form\Form;
use Zend\Form\Element;
use Zend\I18n\Translator\Translator;
use AdfabCore\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\ServiceManager\ServiceManager;

class PrizeFieldset extends Fieldset
{
    protected $serviceManager;

    public function __construct($name = null, ServiceManager $serviceManager, Translator $translator)
    {
        parent::__construct($name);
        $entityManager = $serviceManager->get('doctrine.entitymanager.orm_default');

        $this->setHydrator(new DoctrineHydrator($entityManager, 'AdfabGame\Entity\Prize'))
        ->setObject(new Prize());

        //$this->setAttribute('enctype','multipart/form-data');

        $this->add(array(
            'name' => 'id',
            'type'  => 'Zend\Form\Element\Hidden',
        ));

        $this->add(array(
            'name' => 'title',
            'options' => array(
                'label' => $translator->translate('Title', 'adfabgame'),
            ),
            'attributes' => array(
                'type' => 'text',
                'placeholder' => $translator->translate('Title', 'adfabgame'),
            ),
        ));

        $this->add(array(
            'name' => 'identifier',
            'options' => array(
                'label' => $translator->translate('Slug', 'adfabgame')
            ),
            'attributes' => array(
                'type' => 'text'
            )
        ));

        $this->add(array(
        	'type' => 'Zend\Form\Element\Textarea',
        	'name' => 'content',
       		'options' => array(
       			'label' => $translator->translate('Description', 'adfabgame')
       		),
       		'attributes' => array(
       			'cols' => '10',
       			'rows' => '10',
       			'id' => 'prize_content'
       		)
        ));
        
        $this->add(array(
        	'name' => 'qty',
        	'options' => array(
       			'label' => $translator->translate('Quantity', 'adfabgame')
       		),
       		'attributes' => array(
       			'type' => 'text',
       			'placeholder' => $translator->translate('Quantity', 'adfabgame')
       		)
        ));
        
        $this->add(array(
        	'name' => 'unitPrice',
        	'options' => array(
       			'label' => $translator->translate('Prix', 'adfabgame')
       		),
       		'attributes' => array(
       			'type' => 'text',
       			'placeholder' => $translator->translate('Prix', 'adfabgame')
       		)
        ));
        
        $this->add(array(
       		'type' => 'Zend\Form\Element\Select',
       		'name' => 'currency',
       		'attributes' =>  array(
        		'id' => 'currency',
        		'options' => array(
        			'EU' => $translator->translate('Euro', 'adfabgame'),
       				'DO' => $translator->translate('Dollar', 'adfabgame'),
   				),
       		),
       		'options' => array(
        		'empty_option' => $translator->translate('Choisir la devise', 'adfabgame'),
    			'label' => $translator->translate('Devise utilisée', 'adfabgame'),
       		),
        ));
        
        $this->add(array(
        		'type' => 'Zend\Form\Element\Button',
        		'name' => 'remove',
        		'options' => array(
        				'label' => $translator->translate('Supprimer', 'adfabgame'),
        		),
        		'attributes' => array(
        				'class' => 'delete-button',
        		)
        ));

    }
}
