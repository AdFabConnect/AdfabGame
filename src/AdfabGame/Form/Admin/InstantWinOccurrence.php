<?php

namespace AdfabGame\Form\Admin;

use Zend\Form\Form;
use Zend\Form\Element;
use ZfcBase\Form\ProvidesEventsForm;
use Zend\I18n\Translator\Translator;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\ServiceManager\ServiceManager;

class InstantWinOccurrence extends ProvidesEventsForm
{
    public function __construct($name = null, ServiceManager $serviceManager, Translator $translator)
    {
        parent::__construct($name);

        $entityManager = $serviceManager->get('adfabgame_doctrine_em');

        // The form will hydrate an object of type "QuizQuestion"
        // This is the secret for working with collections with Doctrine
        // (+ add'Collection'() and remove'Collection'() and "cascade" in corresponding Entity
        // https://github.com/doctrine/DoctrineModule/blob/master/docs/hydrator.md
        //$this->setHydrator(new DoctrineHydrator($entityManager, 'AdfabGame\Entity\QuizQuestion'));

        $this->setAttribute('method', 'post');
        //$this->setAttribute('class','form-horizontal');

        $this->add(array(
            'name' => 'instant_win_id',
            'type'  => 'Zend\Form\Element\Hidden',
            'attributes' => array(
                'value' => 0,
            ),
        ));

        $this->add(array(
            'name' => 'id',
            'type'  => 'Zend\Form\Element\Hidden',
            'attributes' => array(
                'value' => 0,
            ),
        ));

        $this->add(array(
            'name' => 'occurrence_date',
            'options' => array(
                'label' => $translator->translate('Occurrence Date', 'adfabgame'),
            ),
            'attributes' => array(
                'type' => 'text',
                'id' => 'occurrence_date'
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'active',
            'options' => array(
            //'empty_option' => $translator->translate('Is the answer correct ?', 'adfabgame'),
                'value_options' => array(
                    '0' => $translator->translate('No', 'adfabgame'),
                    '1' => $translator->translate('Yes', 'adfabgame'),
                ),
                'label' => $translator->translate('Active', 'adfabgame'),
            ),
        ));

        $submitElement = new Element\Button('submit');
        $submitElement
        ->setLabel($translator->translate('Create', 'adfabgame'))
        ->setAttributes(array(
            'type'  => 'submit',
            'class' => 'btn btn-primary',
        ));

        $this->add($submitElement, array(
            'priority' => -100,
        ));

    }
}
