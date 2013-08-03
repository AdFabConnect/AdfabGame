<?php
namespace AdfabGame\Form\Admin;

use AdfabGame\Options\ModuleOptions;
use Zend\Form\Form;
use Zend\Form\Element;
use ZfcBase\Form\ProvidesEventsForm;
use Zend\I18n\Translator\Translator;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;
use Zend\ServiceManager\ServiceManager;

class Game extends ProvidesEventsForm
{

    /**
     *
     * @var ModuleOptions
     */
    protected $module_options;

    protected $serviceManager;

    public function __construct ($name = null, ServiceManager $sm, Translator $translator)
    {
        parent::__construct($name);

        $this->setServiceManager($sm);

        $entityManager = $this->getServiceManager()->get('doctrine.entitymanager.orm_default');

        // The form will hydrate an object of type "QuizQuestion"
        // This is the secret for working with collections with Doctrine
        // (+ add'Collection'() and remove'Collection'() and "cascade" in
        // corresponding Entity
        // https://github.com/doctrine/DoctrineModule/blob/master/docs/hydrator.md
        //$this->setHydrator(new DoctrineHydrator($entityManager, 'AdfabGame\Entity\Game'));

        $this->setAttribute('enctype', 'multipart/form-data');

        $this->add(array(
            'name' => 'id',
            'type' => 'Zend\Form\Element\Hidden',
            'attributes' => array(
                'value' => 0
            )
        ));

        $this->add(array(
            'name' => 'title',
            'options' => array(
                'label' => $translator->translate('Title', 'adfabgame')
            ),
            'attributes' => array(
                'type' => 'text',
                'placeholder' => $translator->translate('Title', 'adfabgame')
            )
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

        // Adding an empty upload field to be able to correctly handle this on
        // the service side.
        $this->add(array(
            'name' => 'uploadMainImage',
            'attributes' => array(
                'type' => 'file'
            ),
            'options' => array(
                'label' => $translator->translate('Main image', 'adfabgame')
            )
        ));
        $this->add(array(
            'name' => 'mainImage',
            'type' => 'Zend\Form\Element\Hidden',
            'attributes' => array(
                'value' => ''
            )
        ));

        // Adding an empty upload field to be able to correctly handle this on
        // the service side.
        $this->add(array(
            'name' => 'uploadSecondImage',
            'attributes' => array(
                'type' => 'file'
            ),
            'options' => array(
                'label' => $translator->translate('Secondary image', 'adfabgame')
            )
        ));
        $this->add(array(
            'name' => 'secondImage',
            'type' => 'Zend\Form\Element\Hidden',
            'attributes' => array(
                'value' => ''
            )
        ));

        $this->add(array(
            'name' => 'canal',
            'options' => array(
                'label' => $translator->translate('Channel', 'adfabgame')
            ),
            'attributes' => array(
                'type' => 'text'
            )
        ));

        /*$this->add(array(
                'name' => 'prize_category',
                'type' => 'DoctrineORMModule\Form\Element\DoctrineEntity',
                'options' => array(
                        'label' => $translator->translate('Catégorie de gain', 'adfabgame'),
                        'object_manager' => $entityManager,
                        'target_class' => 'AdfabGame\Entity\PrizeCategory',
                        'property' => 'title'
                ),
                'attributes' => array(
                        'required' => false
                )
        ));*/

        $categories = $this->getPrizeCategories();
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'prizeCategory',
            'options' => array(
                'empty_option' => $translator->translate('Ce jeu n\'a pas de catégorie', 'adfabgame'),
                'value_options' => $categories,
                'label' => $translator->translate('Catégorie de gain', 'adfabgame')
            )
        ));
/*
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'broadcastFacebook',
            'options' => array(
                'label' => 'Publier ce jeu sur Facebook',
            ),
        ));
*/
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'broadcastPlatform',
            'options' => array(
                'label' => 'Publier ce jeu sur la Plateforme',
            ),
        ));

        $this->add(array(
                'type' => 'Zend\Form\Element\Checkbox',
                'name' => 'displayHome',
                'options' => array(
                        'label' => 'Publier ce jeu sur la home',
                ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'pushHome',
            'options' => array(
                'label' => 'Publier ce jeu sur le slider Home',
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\DateTime',
            'name' => 'publicationDate',
            'options' => array(
                'label' => $translator->translate('Date de publication', 'adfabgame'),
                'format' => 'd/m/Y'
            ),
            'attributes' => array(
                'type' => 'text',
                'class'=> 'datepicker'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\DateTime',
            'name' => 'startDate',
            'options' => array(
                'label' => $translator->translate('Date de début', 'adfabgame'),
                'format' => 'd/m/Y'
            ),
            'attributes' => array(
                'type' => 'text',
                'class'=> 'datepicker'
            )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\DateTime',
            'name' => 'endDate',
            'options' => array(
                'label' => $translator->translate('Date de fin', 'adfabgame'),
                'format' => 'd/m/Y'
            ),
            'attributes' => array(
                'type' => 'text',
                'class'=> 'datepicker'
            )
        )); 

        $this->add(array(
            'type' => 'Zend\Form\Element\DateTime',
            'name' => 'closeDate',
            'options' => array(
                'label' => $translator->translate('Date de dépublication', 'adfabgame'),
                'format' => 'd/m/Y'
            ),
            'attributes' => array(
                'type' => 'text',
                'class'=> 'datepicker'
            )
        ));

        $this->add(array(
                'name' => 'playLimit',
                'type' => 'Zend\Form\Element\Text',
                'attributes' => array(
                        'placeholder' => 'Nombre d\'essais par joueur',
                ),
                'options' => array(
                        'label' => 'Quel est la limite du nombre d\'essais par joueur ?',
                ),
        ));

        $this->add(array(
                'type' => 'Zend\Form\Element\Select',
                'name' => 'playLimitScale',
                'attributes' =>  array(
                        'id' => 'playLimitScale',
                        'options' => array(
                                'day' => $translator->translate('Jour', 'adfabgame'),
                                'week' => $translator->translate('Semaine', 'adfabgame'),
                                'month' => $translator->translate('Mois', 'adfabgame'),
                                'year' => $translator->translate('An', 'adfabgame'),
                                'always' => $translator->translate('Toujours', 'adfabgame'),
                        ),
                ),
                'options' => array(
                        'empty_option' => $translator->translate('Quelle est la durée de limitation ?', 'adfabgame'),
                        'label' => $translator->translate('Durée de la limite', 'adfabgame'),
                ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'playBonus',
            'attributes' =>  array(
                'id' => 'playBonus',
                'options' => array(
                    'none' => $translator->translate('Aucune participation bonus', 'adfabgame'),
                    'per_entry' => $translator->translate('Au max une participation bonus par participation', 'adfabgame'),
                    'one' => $translator->translate('Une seule participation bonus pour le jeu', 'adfabgame'),
                ),
            ),
            'options' => array(
                'empty_option' => $translator->translate('Des participations bonus peuvent-elles être offertes ?', 'adfabgame'),
                'label' => $translator->translate('Participations bonus', 'adfabgame'),
            ),
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'active',
            'options' => array(
                'value_options' => array(
                    '0' => $translator->translate('Non', 'adfabgame'),
                    '1' => $translator->translate('Oui', 'adfabgame')
                ),
                'label' => $translator->translate('Actif', 'adfabgame')
            )
        ));

        $options = $this->getServiceManager()->get('configuration');

        $layoutArray = array(
            '' => $translator->translate('Utiliser le layout par défaut', 'adfabgame')
        );
        if (isset($options['core_layout']) && isset($options['core_layout']['AdfabGame']) && isset($options['core_layout']['AdfabGame']['models'])) {
            $layoutOptions = array();
            $layoutOptions = $options['core_layout']['AdfabGame']['models'];
            foreach ($layoutOptions as $k => $v) {
                $layoutArray[$v['layout']] = $v['description'];
            }
        }

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'layout',
            'options' => array(
                // 'empty_option' => $translator->translate('Ce jeu n\'a pas de catégorie', 'adfabgame'),
                'value_options' => $layoutArray,
                'label' => $translator->translate('Layout', 'adfabgame')
            )
        ));

        // The additional Stylesheets are populated by the controllers
        $stylesheetArray = array(
            '' => $translator->translate('Utiliser la feuille de styles par défaut', 'adfabgame')
        );

        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'stylesheet',
            'options' => array(
                'value_options' => $stylesheetArray,
                'label' => $translator->translate('Feuille de style', 'adfabgame')
            )
        ));

        $this->add(array(
            'name' => 'uploadStylesheet',
            'attributes' => array(
                'type' => 'file'
            ),
            'options' => array(
                'label' => $translator->translate('Ajouter une feuille de style', 'adfabgame')
            )
        ));

        $partners = $this->getPartners();
        if (count($partners) <= 1) {
            $this->add(array(
                'name' => 'partner',
                'type' => 'Zend\Form\Element\Hidden',
                'attributes' => array(
                    'value' => 0
                )
            ));
        } else {
            $this->add(array(
                'type' => 'Zend\Form\Element\Select',
                'name' => 'partner',
                'options' => array(
                    'value_options' => $partners,
                    'label' => $translator->translate('Sponsor', 'adfabgame')
                )
            ));
        }

        $fbAppIds = $this->getFbAppIds();
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'fbAppId',
            'options' => array(
                'value_options' => $fbAppIds,
                'label' => $translator->translate('Facebook Apps', 'adfabgame')
            )
        ));

        $this->add(array(
            'name' => 'fbPageTabTitle',
            'options' => array(
                'label' => $translator->translate('Titre de l\'onglet du jeu', 'adfabgame')
            ),
            'attributes' => array(
                'type' => 'text',
                'placeholder' => $translator->translate('Titre de l\'onglet du jeu', 'adfabgame')
            )
        ));

        $this->add(array(
                'name' => 'uploadFbPageTabImage',
                'attributes' => array(
                        'type' => 'file'
                ),
                'options' => array(
                        'label' => $translator->translate('Icône de l\'onglet du jeu', 'adfabgame')
                )
        ));
        $this->add(array(
                'name' => 'fbPageTabImage',
                'type' => 'Zend\Form\Element\Hidden',
                'attributes' => array(
                        'value' => ''
                )
        ));

        $this->add(array(
            'type' => 'Zend\Form\Element\Textarea',
            'name' => 'welcomeBlock',
            'options' => array(
                'label' => $translator->translate('Bloc de bienvenue', 'adfabgame')
            ),
            'attributes' => array(
                'cols' => '10',
                'rows' => '10',
                'id' => 'welcomeBlock'
            )
        ));
        
        $this->add(array(
        		'type' => 'Zend\Form\Element\Select',
        		'name' => 'termsOptin',
        		'options' => array(
        				//'empty_option' => $translator->translate('Is the answer correct ?', 'adfabgame'),
        				'value_options' => array(
        						'0' => $translator->translate('No', 'adfabgame'),
        						'1' => $translator->translate('Yes', 'adfabgame'),
        				),
        				'label' => $translator->translate('Le joueur doit accepter le règlement pour jouer', 'adfabgame'),
        		),
        ));

        $this->add(array(
                'type' => 'Zend\Form\Element\Textarea',
                'name' => 'termsBlock',
                'options' => array(
                        'label' => $translator->translate('Page de règlement', 'adfabgame')
                ),
                'attributes' => array(
                        'cols' => '10',
                        'rows' => '10',
                        'id' => 'termsBlock'
                )
        ));

        $this->add(array(
                'type' => 'Zend\Form\Element\Textarea',
                'name' => 'columnBlock1',
                'options' => array(
                        'label' => $translator->translate('Bloc colonne de droite 1', 'adfabgame')
                ),
                'attributes' => array(
                        'cols' => '10',
                        'rows' => '10',
                        'id' => 'columnBlock1'
                )
        ));

        $this->add(array(
                'type' => 'Zend\Form\Element\Textarea',
                'name' => 'columnBlock2',
                'options' => array(
                        'label' => $translator->translate('Bloc colonne de droite 2', 'adfabgame')
                ),
                'attributes' => array(
                        'cols' => '10',
                        'rows' => '10',
                        'id' => 'columnBlock2'
                )
        ));

        $this->add(array(
                'type' => 'Zend\Form\Element\Textarea',
                'name' => 'columnBlock3',
                'options' => array(
                        'label' => $translator->translate('Bloc colonne de droite 3', 'adfabgame')
                ),
                'attributes' => array(
                        'cols' => '10',
                        'rows' => '10',
                        'id' => 'columnBlock3'
                )
        ));
        
        $this->add(array(
        	'type' => 'Zend\Form\Element\Select',
        	'name' => 'fbFan',
       		'options' => array(
       			//'empty_option' => $translator->translate('Is the answer correct ?', 'adfabgame'),
       			'value_options' => array(
					'0' => $translator->translate('No', 'adfabgame'),
       				'1' => $translator->translate('Yes', 'adfabgame'),
       			),
       			'label' => $translator->translate('Il faut être fan pour participer', 'adfabgame'),
       		),
        ));

        $this->add(array(
                'type' => 'Zend\Form\Element\Textarea',
                'name' => 'fbShareMessage',
                'options' => array(
                        'label' => $translator->translate('Message de partage Facebook', 'adfabgame')
                ),
                'attributes' => array(
                        'cols' => '10',
                        'rows' => '4',
                        'id' => 'fbShareMessage'
                )
        ));

        $this->add(array(
            'name' => 'uploadFbShareImage',
            'attributes' => array(
                'type' => 'file'
            ),
            'options' => array(
                'label' => $translator->translate('Image de partage Facebook', 'adfabgame')
            )
        ));
        $this->add(array(
            'name' => 'fbShareImage',
            'type' => 'Zend\Form\Element\Hidden',
            'attributes' => array(
                'value' => ''
            )
        ));

        $this->add(array(
                'type' => 'Zend\Form\Element\Textarea',
                'name' => 'fbRequestMessage',
                'options' => array(
                    'label' => $translator->translate('Message d\'invitation Facebook', 'adfabgame')
                ),
                'attributes' => array(
                        'cols' => '10',
                        'rows' => '4',
                        'id' => 'fbRequestMessage'
                )
        ));

        $this->add(array(
                'type' => 'Zend\Form\Element\Textarea',
                'name' => 'twShareMessage',
                'options' => array(
                    'label' => $translator->translate('Message de partage Twitter', 'adfabgame')
                ),
                'attributes' => array(
                    'cols' => '10',
                    'rows' => '4',
                    'id' => 'twShareMessage'
                )
        ));
        
        $prizeFieldset = new PrizeFieldset(null,$sm,$translator);
        $this->add(array(
        		'type'    => 'Zend\Form\Element\Collection',
        		'name'    => 'prizes',
        		'options' => array(
        				'id'    => 'prizes',
        				'label' => $translator->translate('List of prizes', 'adfabgame'),
        				'count' => 0,
        				'should_create_template' => true,
        				'allow_add' => true,
        				'allow_remove' => true,
        				'target_element' => $prizeFieldset
        		)
        ));

        $submitElement = new Element\Button('submit');
        $submitElement->setLabel($translator->translate('Create', 'adfabgame'))
            ->setAttributes(array(
            'type' => 'submit'
        ));

        $this->add($submitElement, array(
            'priority' => - 100
        ));
    }

    /**
     * An event is triggered so that the module AdfabPartnership if installed,
     * can add the partners list without adherence between the 2 modules
     * AdfabGame and AdfabPartnership
     *
     * @return array
     */
    public function getPartners ()
    {
        $partners = array(
            '0' => 'Ce jeu n\'est pas sponsorisé'
        );
        $results = $this->getServiceManager()
            ->get('application')
            ->getEventManager()
            ->trigger(__FUNCTION__, $this, array(
            'partners' => $partners
        ))
            ->last();

        if ($results) {
            $partners = $results;
        }

        //print_r($partners);
        //die();
        return $partners;
    }

    /**
     * An event is triggered so that the module AdfabFacebook if installed,
     * can add the Facebook apps list without adherence between the 2 modules
     * AdfabGame and AdfabFacebook
     *
     * @return array
     */
    public function getFbAppIds ()
    {
        $apps = array('' => 'Ne pas déployer sur Facebook');

        $results = $this->getServiceManager()
            ->get('application')
            ->getEventManager()
            ->trigger(__FUNCTION__, $this, array(
            'apps' => $apps
        ))
            ->last();

        if ($results) {
            $apps = $results;
        }

        return $apps;
    }

    /**
     *
     * @return array
     */
    public function getPrizeCategories ()
    {
        $categories = array();
        $prizeCategoryService = $this->getServiceManager()->get('adfabgame_prizecategory_service');
        $results = $prizeCategoryService->getActivePrizeCategories();

        foreach ($results as $result) {
            $categories[$result->getId()] = $result->getTitle();
        }

        return $categories;
    }

    /**
     * Retrieve service manager instance
     *
     * @return ServiceManager
     */
    public function getServiceManager ()
    {
        return $this->serviceManager;
    }

    /**
     * Set service manager instance
     *
     * @param  ServiceManager $serviceManager
     * @return User
     */
    public function setServiceManager (ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;

        return $this;
    }
}
