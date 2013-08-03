<?php

namespace AdfabGame\Form\Admin;

use Zend\Form\Form;
use Zend\Form\Element;
use ZfcBase\Form\ProvidesEventsForm;
use Zend\I18n\Translator\Translator;
use Zend\ServiceManager\ServiceManager;

class Prize extends ProvidesEventsForm
{
    protected $serviceManager;

    public function __construct($name = null, ServiceManager $serviceManager, Translator $translator)
    {
        parent::__construct($name);

        $entityManager = $serviceManager->get('doctrine.entitymanager.orm_default');

        parent::__construct();
        $this->setAttribute('enctype','multipart/form-data');

        $this->add(array(
            'name' => 'id',
            'type'  => 'Zend\Form\Element\Hidden',
            'attributes' => array(
                'value' => 0,
            ),
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
        		'empty_option' => $translator->translate('Afficher les Posts triés par', 'adfabgame'),
    			'label' => $translator->translate('Mode d\'affichage des Posts', 'adfabgame'),
       		),
        ));
        
        $submitElement = new Element\Button('submit');
        $submitElement
        ->setLabel($translator->translate('Create', 'adfabgame'))
        ->setAttributes(array(
            'type'  => 'submit',
        ));

        $this->add($submitElement, array(
            'priority' => -100,
        ));

    }
}
