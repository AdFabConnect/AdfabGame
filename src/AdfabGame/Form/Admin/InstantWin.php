<?php

namespace AdfabGame\Form\Admin;

use Zend\Form\Form;
use Zend\Form\Element;
use AdfabCore\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\I18n\Translator\Translator;
use Zend\ServiceManager\ServiceManager;

class InstantWin extends Game
{
    public function __construct($name = null, ServiceManager $sm, Translator $translator)
    {
        $this->setServiceManager($sm);
        $entityManager = $sm->get('doctrine.entitymanager.orm_default');

        // Mapping of an Entity to get value by getId()... Should be taken in charge by Doctrine Hydrator Strategy...
        // having to fix a DoctrineModule bug :( https://github.com/doctrine/DoctrineModule/issues/180
        // so i've extended DoctrineHydrator ...
        $hydrator = new DoctrineHydrator($entityManager, 'AdfabGame\Entity\InstantWin');
        $hydrator->addStrategy('partner', new \AdfabCore\Stdlib\Hydrator\Strategy\ObjectStrategy());
        $this->setHydrator($hydrator);

        parent::__construct($name, $sm, $translator);

        /*$this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'occurrenceType',
            'attributes' =>  array(
                'id' => 'occurrenceType',
                'options' => array(
                    'datetime' => $translator->translate('Date', 'adfabgame'),
                    'visitor' => $translator->translate('Visitor', 'adfabgame'),
                    'random' => $translator->translate('Random', 'adfabgame'),
                ),
            ),
            'options' => array(
                'empty_option' => $translator->translate('Type d\'instant gagnant', 'adfabgame'),
                'label' => $translator->translate('Type d\'instant gagnant', 'adfabgame'),
            ),
        ));*/

        $this->add(array(
            'name' => 'occurrenceType',
            'type' => 'Zend\Form\Element\Hidden',
            'attributes' => array(
                'value' => 'random'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'scheduleOccurrenceAuto',
            'attributes' =>  array(
                'id' => 'scheduleOccurrenceAuto',
                'options' => array(
                    '0' => $translator->translate('Non', 'adfabgame'),
                    '1' => $translator->translate('Oui', 'adfabgame'),
                ),
            ),
            'options' => array(
                'label' => $translator->translate('Génération des IG automatique', 'adfabgame'),
            ),
        ));

        $this->add(array(
            'name' => 'occurrenceNumber',
            'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Nombre d\'instants gagnants',
            ),
            'options' => array(
                'label' => 'Nombre d\'instants gagnants',
            ),
        ));
        
        $this->add(array(
        		'type' => 'Zend\Form\Element\Select',
        		'name' => 'occurrenceDrawFrequency',
        		'attributes' =>  array(
        				'id' => 'occurrenceDrawFrequency',
        				'options' => array(
        						'hour' => $translator->translate('heure', 'adfabgame'),
        						'day' => $translator->translate('Jour', 'adfabgame'),
        						'week' => $translator->translate('Semaine', 'adfabgame'),
        						'month' => $translator->translate('Mois', 'adfabgame'),
        						'game' => $translator->translate('Jeu', 'adfabgame'),
        				),
        		),
        		'options' => array(
        				'empty_option' => $translator->translate('Création des instants gagnants sur quelle fréquence ?', 'adfabgame'),
        				'label' => $translator->translate('Fréquence de création', 'adfabgame'),
        		),
        ));

        // Adding an empty upload field to be able to correctly handle this on
        // the service side.
        $this->add(array(
                'name' => 'uploadScratchcardImage',
                'attributes' => array(
                    'type' => 'file'
                ),
                'options' => array(
                    'label' => $translator->translate('Image de grattage du jeu', 'adfabgame')
                )
        ));
        $this->add(array(
                'name' => 'scratchcardImage',
                'type' => 'Zend\Form\Element\Hidden',
                'attributes' => array(
                    'value' => ''
                )
        ));
    }
}
