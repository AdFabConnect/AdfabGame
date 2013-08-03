<?php

namespace AdfabGame\Form\Admin;

use Zend\Form\Form;
use Zend\Form\Element;
use AdfabCore\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\I18n\Translator\Translator;
use Zend\ServiceManager\ServiceManager;

class PostVote extends Game
{

    public function __construct($name = null, ServiceManager $sm, Translator $translator)
    {
        $this->setServiceManager($sm);
        $entityManager = $sm->get('doctrine.entitymanager.orm_default');

        // Mapping of an Entity to get value by getId()... Should be taken in charge by Doctrine Hydrator Strategy...
        // having to fix a DoctrineModule bug :( https://github.com/doctrine/DoctrineModule/issues/180
        $hydrator = new DoctrineHydrator($entityManager, 'AdfabGame\Entity\PostVote');
        $hydrator->addStrategy('partner', new \AdfabCore\Stdlib\Hydrator\Strategy\ObjectStrategy());
        $this->setHydrator($hydrator);

        parent::__construct($name, $sm, $translator);

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'template',
            'attributes' =>  array(
                'id' => 'template',
                'options' => array(
                    'text' => $translator->translate('Texte', 'adfabgame'),
                    'photo' => $translator->translate('Photo', 'adfabgame'),
                    'recipe' => $translator->translate('Recette de cuisine', 'adfabgame'),
                ),
            ),
            'options' => array(
                'empty_option' => $translator->translate('Quel sera le type des Posts ?', 'adfabgame'),
                'label' => $translator->translate('Type de Post', 'adfabgame'),
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'postDisplayMode',
            'attributes' =>  array(
                'id' => 'postDisplayMode',
                'options' => array(
                    'date' => $translator->translate('Date', 'adfabgame'),
                    'vote' => $translator->translate('Nombre de votes', 'adfabgame'),
                    'random' => $translator->translate('Au hasard', 'adfabgame'),
                ),
            ),
            'options' => array(
                'empty_option' => $translator->translate('Afficher les Posts triés par', 'adfabgame'),
                'label' => $translator->translate('Mode d\'affichage des Posts', 'adfabgame'),
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'voteAnonymous',
            'options' => array(
                'label' => 'Autoriser le vote aux visiteurs anonymes',
            ),
        ));
    }
}
