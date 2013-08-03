<?php

return array(
    'doctrine' => array(
        'driver' => array(
            'adfabgame_entity' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => __DIR__ . '/../src/AdfabGame/Entity'
            ),

            'orm_default' => array(
                'drivers' => array(
                    'AdfabGame\Entity'  => 'adfabgame_entity'
                )
            )
        )
    ),
	'assetic_configuration' => array(
		'modules' => array(
			'game' => array(
				# module root path for your css and js files
				'root_path' => __DIR__ . '/../assets',
				# collection of assets
				'collections' => array(
					'admin_treasurehunt_css' => array(
						'assets' => array(
							__DIR__ . '/../assets/css/areapicker/style.min.css',
						),
						'filters' => array(
							'CssRewriteFilter' => array(
								'name' => 'Assetic\Filter\CssRewriteFilter',
							)
						),
						'options' => array(),
					),
					'head_admin_treasurehunt_js' => array(
						'assets' => array(
							__DIR__ . '/../assets/js/areapicker/app.js',
						    __DIR__ . '/../assets/js/areapicker/config.js',
						    __DIR__ . '/../assets/js/areapicker/selection.js',
						    __DIR__ . '/../assets/js/lib/easyxdm/easyxdm.min.js'
						),
						'filters' => array(),
						'options' => array(),
					),
				),
			),
		),

		'routes' => array(
			'zfcadmin/adfabgame/treasure(.*)' => array(
                '@admin_treasurehunt_css',
				'@head_admin_treasurehunt_js',
            ),
		),
	),
    'core_layout' => array(
        'AdfabGame' => array(
            'default_layout' => 'adfab-game/layout/2columns-right',
            'children_views' => array(),
            // Models can be described in this section for being able to use it in the back-office
            'models' => array(
                'one_column' => array(
                    'layout' => 'adfab-game/layout/1column-custom',
                    'description' => 'layout à 1 seule colonne'
                ),
                /*'two_columns_right' => array(
                    'layout' => 'adfab-game/layout/2columns-right-custom',
                    'description' => 'layout à 2 colonnes à droite'
                ),*/
            ),
            'controllers' => array(
                'adfabgame_lottery'   => array(
                    'children_views' => array(
                        'col_right'  => 'adfab-game/layout/col-lottery.phtml',
                    ),
                ),
                'adfabgame_quiz'   => array(
                    'children_views' => array(
                        'col_right'  => 'adfab-game/layout/col-quiz.phtml',
                    ),
                ),
                'adfabgame_instantwin'   => array(
                    'children_views' => array(
                        'col_right'  => 'adfab-game/layout/col-instantwin.phtml',
                    ),
                ),
                'adfabgame_postvote'   => array(
                    'children_views' => array(
                        'col_right'  => 'adfab-game/layout/col-postvote.phtml',
                    ),
                ),
                'adfabgame_prizecategory'   => array(
                    'default_layout' => 'layout/2columns-right',
                    'actions' => array(
                        'index' => array(
                            'default_layout' => 'layout/2columns-right',
                            'children_views' => array(
                                'col_right'  => 'application/common/column_right.phtml',
                            ),
                        ),
                    ),
                ),
                'adfabgame'   => array(
                    'default_layout' => 'adfab-game/layout/1column-custom.phtml',
                    'children_views' => array(
                        'col_right'  => 'adfab-game/layout/col-quiz.phtml',
                    ),
                    'actions' => array(
                        'index' => array(
                            'default_layout' => 'adfab-game/layout/2columns-right',
                            'children_views' => array(
                                'col_right'  => 'adfab-game/layout/col-quiz.phtml',
                            ),
                        ),
                        'photocontestconsultation' => array(
                            'default_layout' => 'layout/2columns-right',
                            'children_views' => array(
                                'col_right'  => 'adfab-game/layout/col-photocontest.phtml',
                            ),
                        ),
                        'photocontestcreate' => array(
                            'default_layout' => 'layout/2columns-right',
                            'children_views' => array(
                                'col_right'  => 'adfab-game/layout/col-photocontest.phtml',
                            ),
                        ),
                        'photocontestoverview' => array(
                            'default_layout' => 'layout/2columns-right',
                            'children_views' => array(
                                'col_right'  => 'adfab-game/layout/col-photocontest.phtml',
                            ),
                        ),
                        'photokitchenconsultation' => array(
                            'default_layout' => 'layout/2columns-right',
                            'children_views' => array(
                                'col_right'  => 'adfab-game/layout/col-photokitchen.phtml',
                            ),
                        ),
                        'photokitchenparticipate' => array(
                            'default_layout' => 'layout/2columns-right',
                            'children_views' => array(
                                'col_right'  => 'adfab-game/layout/col-photokitchen.phtml',
                            ),
                        ),
                        'postvote' => array(
                            'default_layout' => 'layout/2columns-right',
                            'children_views' => array(
                                'col_right'  => 'adfab-game/layout/col-postvote.phtml',
                            ),
                        ),
                        'postvoteconsultation' => array(
                            'default_layout' => 'layout/2columns-right',
                            'children_views' => array(
                                'col_right'  => 'adfab-game/layout/col-postvote.phtml',
                            ),
                        ),
                        'postvotenotlogged' => array(
                            'default_layout' => 'layout/2columns-right',
                            'children_views' => array(
                                'col_right'  => 'adfab-game/layout/col-postvote.phtml',
                            ),
                        ),
                        'postvoteparticipationinscription' => array(
                            'default_layout' => 'layout/2columns-right',
                            'children_views' => array(
                                'col_right'  => 'adfab-game/layout/col-postvote.phtml',
                            ),
                        ),
                        'postvoteparticipation' => array(
                            'default_layout' => 'layout/2columns-right',
                            'children_views' => array(
                                'col_right'  => 'adfab-game/layout/col-postvote.phtml',
                            ),
                        ),
                        'postvotevalidation' => array(
                            'default_layout' => 'layout/2columns-right',
                            'children_views' => array(
                                'col_right'  => 'adfab-game/layout/col-postvote.phtml',
                            ),
                        ),
                        'postvoteinvitation' => array(
                            'default_layout' => 'layout/2columns-right',
                            'children_views' => array(
                                'col_right'  => 'adfab-game/layout/col-postvote.phtml',
                            ),
                        ),
                        'postvoterecirculation' => array(
                            'default_layout' => 'layout/2columns-right',
                            'children_views' => array(
                                'col_right'  => 'adfab-game/layout/col-postvote.phtml',
                            ),
                        ),
                    )
                ),
            ),
        ),
    ),

    'view_manager' => array(
        'template_map' => array(
            'adfab-game/lottery/index'               => __DIR__ .  '/../view/adfab-game/frontend/lottery/index.phtml',
            'adfab-game/lottery/result'              => __DIR__ .  '/../view/adfab-game/frontend/lottery/result.phtml',
            'adfab-game/lottery/bounce'              => __DIR__ .  '/../view/adfab-game/frontend/lottery/bounce.phtml',
            'adfab-game/lottery/terms'               => __DIR__ .  '/../view/adfab-game/frontend/lottery/terms.phtml',
        	'adfab-game/lottery/fangate'             => __DIR__ .  '/../view/adfab-game/frontend/lottery/fangate.phtml',
        	'adfab-game/lottery/prizes' 		 	 => __DIR__ .  '/../view/adfab-game/frontend/lottery/prizes.phtml',
        	'adfab-game/lottery/prize' 			 	 => __DIR__ .  '/../view/adfab-game/frontend/lottery/prize.phtml',
            'adfab-game/post-vote/index'             => __DIR__ .  '/../view/adfab-game/frontend/postvote/index.phtml',
            'adfab-game/post-vote/list'              => __DIR__ .  '/../view/adfab-game/frontend/postvote/list.phtml',
            'adfab-game/post-vote/play'              => __DIR__ .  '/../view/adfab-game/frontend/postvote/play.phtml',
            'adfab-game/post-vote/post'              => __DIR__ .  '/../view/adfab-game/frontend/postvote/post.phtml',
            'adfab-game/post-vote/preview'           => __DIR__ .  '/../view/adfab-game/frontend/postvote/preview.phtml',
            'adfab-game/post-vote/result'            => __DIR__ .  '/../view/adfab-game/frontend/postvote/result.phtml',
            'adfab-game/post-vote/bounce'            => __DIR__ .  '/../view/adfab-game/frontend/postvote/bounce.phtml',
            'adfab-game/post-vote/terms'             => __DIR__ .  '/../view/adfab-game/frontend/postvote/terms.phtml',
        	'adfab-game/post-vote/fangate'           => __DIR__ .  '/../view/adfab-game/frontend/postvote/fangate.phtml',
        	'adfab-game/post-vote/prizes' 		 	 => __DIR__ .  '/../view/adfab-game/frontend/post-vote/prizes.phtml',
        	'adfab-game/post-vote/prize' 			 => __DIR__ .  '/../view/adfab-game/frontend/post-vote/prize.phtml',
            'adfab-game/quiz/index'                  => __DIR__ .  '/../view/adfab-game/frontend/quiz/index.phtml',
            'adfab-game/quiz/play'                   => __DIR__ .  '/../view/adfab-game/frontend/quiz/play.phtml',
            'adfab-game/quiz/result'                 => __DIR__ .  '/../view/adfab-game/frontend/quiz/result.phtml',
            'adfab-game/quiz/bounce'                 => __DIR__ .  '/../view/adfab-game/frontend/quiz/bounce.phtml',
            'adfab-game/quiz/terms'                  => __DIR__ .  '/../view/adfab-game/frontend/quiz/terms.phtml',
        	'adfab-game/quiz/fangate'                => __DIR__ .  '/../view/adfab-game/frontend/quiz/fangate.phtml',
        	'adfab-game/quiz/prizes' 		 	 	 => __DIR__ .  '/../view/adfab-game/frontend/quiz/prizes.phtml',
        	'adfab-game/quiz/prize' 			 	 => __DIR__ .  '/../view/adfab-game/frontend/quiz/prize.phtml',
            'adfab-game/instant-win/index'           => __DIR__ .  '/../view/adfab-game/frontend/instantwin/index.phtml',
            'adfab-game/instant-win/play'            => __DIR__ .  '/../view/adfab-game/frontend/instantwin/play.phtml',
            'adfab-game/instant-win/result'          => __DIR__ .  '/../view/adfab-game/frontend/instantwin/result.phtml',
            'adfab-game/instant-win/bounce'          => __DIR__ .  '/../view/adfab-game/frontend/instantwin/bounce.phtml',
            'adfab-game/instant-win/terms'           => __DIR__ .  '/../view/adfab-game/frontend/instantwin/terms.phtml',
        	'adfab-game/instant-win/fangate'         => __DIR__ .  '/../view/adfab-game/frontend/instantwin/fangate.phtml',
        	'adfab-game/instant-win/prizes' 		 => __DIR__ .  '/../view/adfab-game/frontend/instantwin/prizes.phtml',
        	'adfab-game/instant-win/prize' 			 => __DIR__ .  '/../view/adfab-game/frontend/instantwin/prize.phtml',
            'adfab-game/prize-category/index'        => __DIR__ .  '/../view/adfab-game/frontend/prize-category/index.phtml',
            'adfab-game/quiz/leaderboard'            => __DIR__ .  '/../view/adfab-game/admin/quiz/leaderboard.phtml',
            'adfab-game/quiz/list-question'          => __DIR__ .  '/../view/adfab-game/admin/quiz/list-question.phtml',
            'adfab-game/quiz/quiz'                   => __DIR__ .  '/../view/adfab-game/admin/quiz/quiz.phtml',
            'adfab-game/quiz/question'               => __DIR__ .  '/../view/adfab-game/admin/quiz/question.phtml',
            'adfab-game/instant-win/leaderboard'     => __DIR__ .  '/../view/adfab-game/admin/instant-win/leaderboard.phtml',
            'adfab-game/instant-win/list-occurrence' => __DIR__ .  '/../view/adfab-game/admin/instant-win/list-occurrence.phtml',
            'adfab-game/instant-win/instantwin'      => __DIR__ .  '/../view/adfab-game/admin/instant-win/instantwin.phtml',
            'adfab-game/instant-win/occurrence'      => __DIR__ .  '/../view/adfab-game/admin/instant-win/occurrence.phtml',
            'adfab-game/post-vote/leaderboard'       => __DIR__ .  '/../view/adfab-game/admin/post-vote/leaderboard.phtml',
            'adfab-game/post-vote/form'              => __DIR__ .  '/../view/adfab-game/admin/post-vote/form.phtml',
            'adfab-game/post-vote/mod-list'          => __DIR__ .  '/../view/adfab-game/admin/post-vote/mod-list.phtml',
            'adfab-game/post-vote/moderation-edit'   => __DIR__ .  '/../view/adfab-game/admin/post-vote/moderation-edit.phtml',
            'adfab-game/lottery/leaderboard'         => __DIR__ .  '/../view/adfab-game/admin/lottery/leaderboard.phtml',
            'adfab-game/prize-category/list'         => __DIR__ .  '/../view/adfab-game/admin/prize-category/list.phtml',
            'adfab-game/prize-category/add'          => __DIR__ .  '/../view/adfab-game/admin/prize-category/add.phtml',
            'adfab-game/prize-category/edit'         => __DIR__ .  '/../view/adfab-game/admin/prize-category/edit.phtml',
        	'adfab-game/admin/game-form'         	 => __DIR__ .  '/../view/adfab-game/admin/game-form.phtml',
        	'adfab-game/admin/lottery'               => __DIR__ .  '/../view/adfab-game/admin/lottery/lottery.phtml',
       		'adfab-game/admin/instant-win'			 => __DIR__ .  '/../view/adfab-game/admin/instant-win/instantwin.phtml',
        	'adfab-game/admin/instant-win/occurrence'=> __DIR__ .  '/../view/adfab-game/admin/instant-win/occurrence.phtml',
        	'adfab-game/admin/post-vote'             => __DIR__ .  '/../view/adfab-game/admin/post-vote/postvote.phtml',
        	'adfab-game/admin/prize-category'        => __DIR__ .  '/../view/adfab-game/admin/prize-category/prize-category.phtml',
        	'adfab-game/admin/quiz/question'         => __DIR__ .  '/../view/adfab-game/admin/quiz/question.phtml',
        	'adfab-game/admin/quiz'                  => __DIR__ .  '/../view/adfab-game/admin/quiz/quiz.phtml',
        	'adfab-game/admin/list'                  => __DIR__ .  '/../view/adfab-game/admin/list.phtml',
        	'adfab-game/admin/pagination_gamelist'   => __DIR__ .  '/../view/adfab-game/admin/pagination_gamelist.phtml',
        	'adfab-game/admin/instant-win/pagination_occurencelist'   => __DIR__ .  '/../view/adfab-game/admin/instant-win/pagination_occurencelist.phtml',
            'adfab-game/admin/pagination_entrylist'  => __DIR__ .  '/../view/adfab-game/admin/pagination_entrylist.phtml',
        	'adfab-game/treasure-hunt/list-step'     => __DIR__ .  '/../view/adfab-game/admin/treasure-hunt/list-step.phtml',
        	'adfab-game/treasure-hunt/step'     => __DIR__ .  '/../view/adfab-game/admin/treasure-hunt/step.phtml',
        ),
        'template_path_stack' => array(
            'adfabgame' => __DIR__ . '/../view',
        ),
    ),

    'translator' => array(
        'locale' => 'fr_FR',
        'translation_file_patterns' => array(
            array(
                'type'         => 'phpArray',
                'base_dir'     => __DIR__ . '/../language',
                'pattern'      => '%s.php',
                'text_domain'  => 'adfabgame'
            ),
        ),
    ),

    'controllers' => array(
        'invokables' => array(
            'adfabgame'                     => 'AdfabGame\Controller\IndexController',
            'adfabgame_lottery'             => 'AdfabGame\Controller\Frontend\LotteryController',
            'adfabgame_quiz'                => 'AdfabGame\Controller\Frontend\QuizController',
            'adfabgame_instantwin'          => 'AdfabGame\Controller\Frontend\InstantWinController',
            'adfabgame_postvote'            => 'AdfabGame\Controller\Frontend\PostVoteController',
            'adfabgame_prizecategory'       => 'AdfabGame\Controller\Frontend\PrizeCategoryController',
            'adfabgameadmin'                => 'AdfabGame\Controller\Admin\AdminController',
            'adfabgame_admin_lottery'       => 'AdfabGame\Controller\Admin\LotteryController',
            'adfabgame_admin_instantwin'    => 'AdfabGame\Controller\Admin\InstantWinController',
            'adfabgame_admin_postvote'      => 'AdfabGame\Controller\Admin\PostVoteController',
            'adfabgame_admin_quiz'          => 'AdfabGame\Controller\Admin\QuizController',
        	'adfabgame_admin_treasurehunt'  => 'AdfabGame\Controller\Admin\TreasureHuntController',
            'adfabgame_admin_prizecategory' => 'AdfabGame\Controller\Admin\PrizeCategoryController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'game' => array(
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => array(
                    'route'    => '/jeu[/:id]',
                    'defaults' => array(
                        'controller' => 'adfabgame',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' =>array(
                    'bounce' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/bounce',
                            'defaults' => array(
                                'controller' => 'adfabgame',
                                'action'     => 'bounce',
                            ),
                        ),
                    ),
                ),
            ),

            'quiz' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/quiz[/:id]',
                    'defaults' => array(
                        'controller' => 'adfabgame_quiz',
                        'action'     => 'index'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'play' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/jouer',
                            'defaults' => array(
                                'controller' => 'adfabgame_quiz',
                                'action'     => 'play',
                            ),
                        ),
                    ),
                    'result' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/resultat',
                            'defaults' => array(
                                'controller' => 'adfabgame_quiz',
                                'action'     => 'result',
                            ),
                        ),
                    ),
                    'fbshare' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/fbshare',
                            'defaults' => array(
                                'controller' => 'adfabgame_quiz',
                                'action'     => 'fbshare',
                            ),
                        ),
                    ),
                    'tweet' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/tweet',
                            'defaults' => array(
                                'controller' => 'adfabgame_quiz',
                                'action'     => 'tweet',
                            ),
                        ),
                    ),
                    'google' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/google',
                            'defaults' => array(
                                'controller' => 'adfabgame_quiz',
                                'action'     => 'google',
                            ),
                        ),
                    ),
                    'bounce' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/essayez-aussi',
                            'defaults' => array(
                                'controller' => 'adfabgame_quiz',
                                'action'     => 'bounce'
                            ),
                        ),
                    ),
                    'terms' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/reglement',
                            'defaults' => array(
                                'controller' => 'adfabgame_quiz',
                                'action'     => 'terms'
                            ),
                        ),
                    ),
                	'fangate' => array(
               			'type' => 'Literal',
           				'options' => array(
       						'route' => '/fangate',
                			'defaults' => array(
           						'controller' => 'adfabgame_quiz',
                				'action'     => 'fangate',
               				),
                		),
               		),
                    'prizes' => array(
                    		'type' => 'Literal',
                    		'options' => array(
                    				'route' => '/lots',
                    				'defaults' => array(
                    						'controller' => 'adfabgame_quiz',
                    						'action'     => 'prizes',
                    				),
                    		),
                    		'may_terminate' => true,
                    		'child_routes' => array(
                    				'prize' => array(
                    						'type' => 'Segment',
                    						'options' => array(
                    								'route' => '/:prize',
                    								'defaults' => array(
                    										'controller' => 'adfabgame_quiz',
                    										'action'     => 'prize',
                    								),
                    						),
                    				),
                    		),
                    ),
                ),
            ),

            'lottery' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/loterie[/:id]',
                    'defaults' => array(
                        'controller' => 'adfabgame_lottery',
                        'action'     => 'index'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'play' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/jouer',
                            'defaults' => array(
                                'controller' => 'adfabgame_lottery',
                                'action'     => 'play',
                            ),
                        ),
                    ),
                    'result' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/resultat',
                            'defaults' => array(
                                'controller' => 'adfabgame_lottery',
                                'action'     => 'result',
                            ),
                        ),
                    ),
                    'fbshare' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/fbshare',
                            'defaults' => array(
                                'controller' => 'adfabgame_lottery',
                                'action'     => 'fbshare',
                            ),
                        ),
                    ),
                    'tweet' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/tweet',
                            'defaults' => array(
                                'controller' => 'adfabgame_lottery',
                                'action'     => 'tweet',
                            ),
                        ),
                    ),
                    'google' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/google',
                            'defaults' => array(
                                'controller' => 'adfabgame_lottery',
                                'action'     => 'google',
                            ),
                        ),
                    ),
                    'bounce' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/essayez-aussi',
                            'defaults' => array(
                                'controller' => 'adfabgame_lottery',
                                'action'     => 'bounce'
                            ),
                        ),
                    ),
                    'terms' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/reglement',
                            'defaults' => array(
                                'controller' => 'adfabgame_lottery',
                                'action'     => 'terms'
                            ),
                        ),
                    ),
                	'fangate' => array(
           				'type' => 'Literal',
           				'options' => array(
           					'route' => '/fangate',
                			'defaults' => array(
                				'controller' => 'adfabgame_lottery',
               					'action'     => 'fangate',
           					),
           				),
              		),
                    'prizes' => array(
                		'type' => 'Literal',
                		'options' => array(
            				'route' => '/lots',
            				'defaults' => array(
        						'controller' => 'adfabgame_lottery',
        						'action'     => 'prizes',
            				),
                		),
                		'may_terminate' => true,
                		'child_routes' => array(
            				'prize' => array(
        						'type' => 'Segment',
        						'options' => array(
    								'route' => '/:prize',
    								'defaults' => array(
										'controller' => 'adfabgame_lottery',
										'action'     => 'prize',
    								),
        						),
            				),
                		),
                    ),
                ),
            ),

            'instantwin' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/instant-gagnant[/:id]',
                    'defaults' => array(
                        'controller' => 'adfabgame_instantwin',
                        'action'     => 'index'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' =>array(
                    'play' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/jouer',
                            'defaults' => array(
                                'controller' => 'adfabgame_instantwin',
                                'action'     => 'play',
                            ),
                        ),
                    ),
                    'result' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/resultat',
                            'defaults' => array(
                                'controller' => 'adfabgame_instantwin',
                                'action'     => 'result',
                            ),
                        ),
                    ),
                    'fbshare' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/fbshare',
                            'defaults' => array(
                                'controller' => 'adfabgame_instantwin',
                                'action'     => 'fbshare',
                            ),
                        ),
                    ),
                    'tweet' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/tweet',
                            'defaults' => array(
                                'controller' => 'adfabgame_instantwin',
                                'action'     => 'tweet',
                            ),
                        ),
                    ),
                    'google' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/google',
                            'defaults' => array(
                                'controller' => 'adfabgame_instantwin',
                                'action'     => 'google',
                            ),
                        ),
                    ),
                    'bounce' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/essayez-aussi',
                            'defaults' => array(
                                'controller' => 'adfabgame_instantwin',
                                'action'     => 'bounce'
                            ),
                        ),
                    ),
                    'terms' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/reglement',
                            'defaults' => array(
                                'controller' => 'adfabgame_instantwin',
                                'action'     => 'terms'
                            ),
                        ),
                    ),
                	'fangate' => array(
               			'type' => 'Literal',
           				'options' => array(
                			'route' => '/fangate',
                			'defaults' => array(
   								'controller' => 'adfabgame_instantwin',
                				'action'     => 'fangate',
                			),
               			),
               		),
                	'prizes' => array(
                		'type' => 'Literal',
                		'options' => array(
       						'route' => '/lots',
                			'defaults' => array(
               					'controller' => 'adfabgame_instantwin',
   								'action'     => 'prizes',
                			),
                		),
                		'may_terminate' => true,
                		'child_routes' => array(
               				'prize' => array(
   								'type' => 'Segment',
                				'options' => array(
                					'route' => '/:prize',
      								'defaults' => array(
                						'controller' => 'adfabgame_instantwin',
      									'action'     => 'prize',
                					),
                				),
                			),
                		),
                	),
                ),
            ),

            'postvote' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/post-vote[/:id]',
                    'defaults' => array(
                        'controller' => 'adfabgame_postvote',
                        'action'     => 'index'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'list' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/liste/:filter',
                            'defaults' => array(
                                'controller' => 'adfabgame_postvote',
                                'action'     => 'list',
                                'filter' 	 => 0,
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'pagination' => array(
                                'type'    => 'Segment',
                                'options' => array(
                                    'route'    => '[/:p]',
                                    'defaults' => array(
                                        'controller' => 'adfabgame_postvote',
                                        'action'     => 'list',
                                    ),
                                ),
                            ),
                        ),
                    ),
                    'play' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/jouer',
                            'defaults' => array(
                                'controller' => 'adfabgame_postvote',
                                'action'     => 'play',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'preview' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/previsualiser',
                                    'defaults' => array(
                                        'controller' => 'adfabgame_postvote',
                                        'action'     => 'preview',
                                    ),
                                ),
                            ),
                            'ajaxupload' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/ajaxupload',
                                    'defaults' => array(
                                        'controller' => 'adfabgame_postvote',
                                        'action'     => 'ajaxupload',
                                    ),
                                ),
                            ),
                            'ajaxdelete' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/ajaxdelete',
                                    'defaults' => array(
                                        'controller' => 'adfabgame_postvote',
                                        'action'     => 'ajaxdelete',
                                    ),
                                ),
                            ),
                        ),
                    ),
                    'post' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/post/:post',
                            'defaults' => array(
                                'controller' => 'adfabgame_postvote',
                                'action'     => 'post',
                            ),
                        ),
                        'may_terminate' => true,
                        'child_routes' => array(
                            'captcha' => array(
                                'type'    => 'segment',
                                'options' => array(
                                    'route'    =>  '/captcha/[:id]',
                                    'defaults' => array(
                                        'controller' => 'adfabgame_postvote',
                                        'action'     => 'captcha',
                                    ),
                                ),
                            ),
                        ),
                    ),
                    'vote' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/vote[/:post]',
                            'defaults' => array(
                                'controller' => 'adfabgame_postvote',
                                'action'     => 'ajaxVote',
                            ),
                        ),
                    ),
                    'result' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/resultat',
                            'defaults' => array(
                                'controller' => 'adfabgame_postvote',
                                'action'     => 'result',
                            ),
                        ),
                    ),
                    'fbshare' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/fbshare',
                            'defaults' => array(
                                'controller' => 'adfabgame_postvote',
                                'action'     => 'fbshare',
                            ),
                        ),
                    ),
                    'tweet' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/tweet',
                            'defaults' => array(
                                'controller' => 'adfabgame_postvote',
                                'action'     => 'tweet',
                            ),
                        ),
                    ),
                    'google' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/google',
                            'defaults' => array(
                                'controller' => 'adfabgame_postvote',
                                'action'     => 'google',
                            ),
                        ),
                    ),
                    'bounce' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/essayez-aussi',
                            'defaults' => array(
                                'controller' => 'adfabgame_postvote',
                                'action'     => 'bounce'
                            ),
                        ),
                    ),
                    'terms' => array(
                        'type' => 'Literal',
                        'options' => array(
                            'route' => '/reglement',
                            'defaults' => array(
                                'controller' => 'adfabgame_postvote',
                                'action'     => 'terms'
                            ),
                        ),
                    ),
                	'fangate' => array(
                		'type' => 'Literal',
               			'options' => array(
               				'route' => '/fangate',
               				'defaults' => array(
              					'controller' => 'adfabgame_postvote',
              					'action'     => 'fangate',
              				),
               			),
               		),
                	'prizes' => array(
                		'type' => 'Literal',
                		'options' => array(
                			'route' => '/lots',
                			'defaults' => array(
                				'controller' => 'adfabgame_postvote',
                				'action'     => 'prizes',
                			),
                		),
                		'may_terminate' => true,
                		'child_routes' => array(
                			'prize' => array(
                				'type' => 'Segment',
                				'options' => array(
                					'route' => '/:prize',
                					'defaults' => array(
                						'controller' => 'adfabgame_postvote',
                						'action'     => 'prize',
                					),
                				),
                			),
                		),
                	),
                ),
            ),
            'prizecategories' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/thematiques/:id',
                    'constraints' => array(
                        'id' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ),
                    'defaults' => array(
                        'controller' => 'adfabgame_prizecategory',
                        'action'     => 'index',
                        'id'		 => ''
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'pagination' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '[/:p]',
                            'defaults' => array(
                                'controller' => 'adfabgame_prizecategory',
                                'action'     => 'index',
                            ),
                        ),
                    ),
                ),
            ),
            'photocontestconsultation' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/photo-contest-consultation',
                    'defaults' => array(
                        'controller' => 'adfabgame',
                        'action'     => 'photocontestconsultation'
                    ),
                ),
            ),
            'photocontestcreate' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/photo-contest-create',
                    'defaults' => array(
                        'controller' => 'adfabgame',
                        'action'     => 'photocontestcreate'
                    ),
                ),
            ),
            'photocontestoverview' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/photo-contest-overview',
                    'defaults' => array(
                        'controller' => 'adfabgame',
                        'action'     => 'photocontestoverview'
                    ),
                ),
            ),
            'photokitchenconsultation' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/photo-kitchen-consultation',
                    'defaults' => array(
                        'controller' => 'adfabgame',
                        'action'     => 'photokitchenconsultation'
                    ),
                ),
            ),
            'photokitchenparticipate' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/photo-kitchen-participate',
                    'defaults' => array(
                        'controller' => 'adfabgame',
                        'action'     => 'photokitchenparticipate'
                    ),
                ),
            ),
            'postvoteconsultation' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/post-vote-consultation',
                    'defaults' => array(
                        'controller' => 'adfabgame',
                        'action'     => 'postvoteconsultation'
                    ),
                ),
            ),
            'postvotenotlogged' => array(
                'type' => 'Literal',
                'options' => array(
                    'route' => '/post-vote-not-logged',
                    'defaults' => array(
                        'controller' => 'adfabgame',
                        'action'     => 'postvotenotlogged'
                    ),
                ),
            ),

            'zfcadmin' => array(
                'child_routes' => array(
                    'quiz' => array(
                        'type' => 'Literal',
                        'priority' => 1000,
                        'options' => array(
                            'route' => '/quiz',
                            'defaults' => array(
                                'controller' => 'adfabgame_admin_quiz',
                                'action'     => 'index',
                            ),
                        ),
                        'child_routes' =>array(
                            'leaderboard' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/leaderboard/:gameId[/:p]',
                                    'defaults' => array(
                                        'controller' => 'adfabgame_admin_quiz',
                                        'action'     => 'leaderboard',
                                        'gameId'     => 0
                                    ),
                                ),
                            ),
                            'download' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/download/:gameId',
                                    'defaults' => array(
                                        'controller' => 'adfabgame_admin_quiz',
                                        'action'     => 'download',
                                    ),
                                ),
                            ),
                            'draw' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/draw/:gameId',
                                    'defaults' => array(
                                        'controller' => 'adfabgame_admin_lottery',
                                        'action'     => 'draw',
                                    ),
                                ),
                            ),
                        ),
                    ),
                    'lottery' => array(
                        'type' => 'Literal',
                        'priority' => 1000,
                        'options' => array(
                            'route' => '/lottery',
                            'defaults' => array(
                                'controller' => 'adfabgame_admin_lottery',
                                'action'     => 'index',
                            ),
                        ),
                        'child_routes' =>array(
                            'leaderboard' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/leaderboard/:gameId[/:p]',
                                    'defaults' => array(
                                        'controller' => 'adfabgame_admin_lottery',
                                        'action'     => 'leaderboard',
                                        'gameId'     => 0
                                    ),
                                ),
                            ),
                            'download' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/download/:gameId',
                                    'defaults' => array(
                                        'controller' => 'adfabgame_admin_lottery',
                                        'action'     => 'download',
                                    ),
                                ),
                            ),
                            'draw' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/draw/:gameId',
                                    'defaults' => array(
                                        'controller' => 'adfabgame_admin_lottery',
                                        'action'     => 'draw',
                                    ),
                                ),
                            ),
                        ),
                    ),
                    'instantwin' => array(
                        'type' => 'Literal',
                        'priority' => 1000,
                        'options' => array(
                            'route' => '/instantwin',
                            'defaults' => array(
                                'controller' => 'adfabgame_admin_instantwin',
                                'action'     => 'index',
                            ),
                        ),
                        'child_routes' =>array(
                            'leaderboard' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/leaderboard/:gameId[/:p]',
                                    'defaults' => array(
                                    	'controller' => 'adfabgame_admin_instantwin',
                                        'action'     => 'leaderboard',
                                        'gameId'     => 0
                                    ),
                                ),
                            ),
                            'download' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/download/:gameId',
                                    'defaults' => array(
                                        'controller' => 'adfabgame_admin_instantwin',
                                        'action'     => 'download',
                                    ),
                                ),
                            ),
                        ),
                    ),
                    'postvote' => array(
                            'type' => 'Literal',
                            'priority' => 1000,
                            'options' => array(
                                    'route' => '/postvote',
                                    'defaults' => array(
                                            'controller' => 'adfabgame_admin_postvote',
                                            'action'     => 'index',
                                    ),
                            ),
                            'child_routes' =>array(
                                    'leaderboard' => array(
                                        'type' => 'Segment',
                                        'options' => array(
                                            'route' => '/leaderboard/:gameId[/:p]',
                                            'defaults' => array(
                                                'controller' => 'adfabgame_admin_postvote',
                                                'action'     => 'leaderboard',
                                                'gameId'     => 0
                                            ),
                                        ),
                                    ),
                                    'download' => array(
                                            'type' => 'Segment',
                                            'options' => array(
                                                    'route' => '/download/:gameId',
                                                    'defaults' => array(
                                                            'controller' => 'adfabgame_admin_postvote',
                                                            'action'     => 'download',
                                                    ),
                                            ),
                                    ),
                            ),
                    ),
                		'treasurehunt' => array(
                				'type' => 'Literal',
                				'priority' => 1000,
                				'options' => array(
                						'route' => '/treasurehunt',
                						'defaults' => array(
                								'controller' => 'adfabgame_admin_treasurehunt',
                								'action'     => 'index',
                						),
                				),
                				'child_routes' =>array(
                						'leaderboard' => array(
                								'type' => 'Segment',
                								'options' => array(
                										'route' => '/leaderboard/:gameId[/:p]',
                										'defaults' => array(
                												'controller' => 'adfabgame_admin_treasurehunt',
                												'action'     => 'leaderboard',
                												'gameId'     => 0
                										),
                								),
                						),
                						'download' => array(
                								'type' => 'Segment',
                								'options' => array(
                										'route' => '/download/:gameId',
                										'defaults' => array(
                												'controller' => 'adfabgame_admin_treasurehunt',
                												'action'     => 'download',
                										),
                								),
                						),
                				),
                		),
                    'adfabgame' => array(
                        'type' => 'Literal',
                        'priority' => 1000,
                        'options' => array(
                            'route' => '/game',
                            'defaults' => array(
                                'controller' => 'adfabgameadmin',
                                'action'     => 'index',
                            ),
                        ),
                        'child_routes' =>array(
                            'list' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/list/:type/:filter[/:p]',
                                    'defaults' => array(
                                        'controller' => 'adfabgameadmin',
                                        'action'     => 'list',
                                        'type'  	 => 'createdAt',
                                        'filter' 	 => 'DESC',
                                    ),
                                ),
                            ),
                            'create' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/create',
                                    'defaults' => array(
                                        'controller' => 'adfabgameadmin',
                                        'action'     => 'create'
                                    ),
                                ),
                            ),
                            'create-lottery' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/create-lottery',
                                    'defaults' => array(
                                        'controller' => 'adfabgame_admin_lottery',
                                        'action'     => 'createLottery'
                                    ),
                                ),
                            ),
                            'edit-lottery' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/edit-lottery/:gameId',
                                    'defaults' => array(
                                        'controller' => 'adfabgame_admin_lottery',
                                        'action'     => 'editLottery',
                                        'gameId'     => 0
                                    ),
                                ),
                            ),
                            'create-instantwin' => array(
                                    'type' => 'Literal',
                                    'options' => array(
                                            'route' => '/create-instantwin',
                                            'defaults' => array(
                                                    'controller' => 'adfabgame_admin_instantwin',
                                                    'action'     => 'createInstantWin'
                                            ),
                                    ),
                            ),
                            'edit-instantwin' => array(
                                    'type' => 'Segment',
                                    'options' => array(
                                            'route' => '/edit-instantwin/:gameId',
                                            'defaults' => array(
                                                    'controller' => 'adfabgame_admin_instantwin',
                                                    'action'     => 'editInstantWin',
                                                    'gameId'     => 0
                                            ),
                                    ),
                            ),
                            'instantwin-occurrence-list' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/instantwin-occurrence-list/:gameId[/:filter][/:p]',
                                    'defaults' => array(
                                        'controller'   => 'adfabgame_admin_instantwin',
                                        'action'       => 'listOccurrence',
                                        'gameId'	   => 0,
                                        'filter'	   => 'DESC'
                                    ),
                                    'constraints' => array(
                                        'filter' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                    ),
                                ),
                            ),
                            'instantwin-occurrence-add' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/instantwin-occurrence-add/:gameId',
                                    'defaults' => array(
                                        'controller' => 'adfabgame_admin_instantwin',
                                        'action'     => 'addOccurrence',
                                        'gameId'     => 0
                                    ),
                                ),
                            ),
                            'instantwin-occurrence-edit' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/instantwin-occurrence-edit/:gameId/:occurrenceId',
                                    'defaults' => array(
                                        'controller' => 'adfabgame_admin_instantwin',
                                        'action'     => 'editOccurrence',
                                        'gameId'     => 0,
                                        'occurrenceId'     => 0
                                    ),
                                ),
                            ),
                            'instantwin-occurrence-remove' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/instantwin-occurrence-remove/:occurrenceId',
                                    'defaults' => array(
                                        'controller' => 'adfabgame_admin_instantwin',
                                        'action'     => 'removeOccurrence',
                                        'occurrenceId'     => 0
                                    ),
                                ),
                            ),
                            'create-quiz' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/create-quiz',
                                    'defaults' => array(
                                        'controller' => 'adfabgame_admin_quiz',
                                        'action'     => 'createQuiz'
                                    ),
                                ),
                            ),
                            'edit-quiz' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/edit-quiz/:gameId',
                                    'defaults' => array(
                                        'controller' => 'adfabgame_admin_quiz',
                                        'action'     => 'editQuiz',
                                        'gameId'     => 0
                                    ),
                                ),
                            ),
                            'create-postvote' => array(
                                'type' => 'Literal',
                                'options' => array(
                                    'route' => '/create-postvote',
                                    'defaults' => array(
                                        'controller' => 'adfabgame_admin_postvote',
                                        'action'     => 'createPostVote'
                                    ),
                                ),
                            ),
                            'edit-postvote' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/edit-postvote/:gameId',
                                    'defaults' => array(
                                        'controller' => 'adfabgame_admin_postvote',
                                        'action'     => 'editPostVote',
                                        'gameId'     => 0
                                    ),
                                ),
                            ),
                            'postvote-form' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/postvote-form/:gameId',
                                    'defaults' => array(
                                        'controller'   => 'adfabgame_admin_postvote',
                                        'action'       => 'form',
                                        'gameId' => 0
                                    ),
                                ),
                            ),
                            'postvote-mod-list' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/postvote-mod-list',
                                    'defaults' => array(
                                        'controller' => 'adfabgame_admin_postvote',
                                        'action'     => 'modList'
                                    ),
                                ),
                            ),
                            'postvote-moderation-edit' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/postvote-moderation-edit/:postId[/:status]',
                                    'defaults' => array(
                                        'controller' => 'adfabgame_admin_postvote',
                                        'action'     => 'moderationEdit'
                                    ),
                                ),
                            ),

                            'leaderboard' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/leaderboard/:gameId',
                                    'defaults' => array(
                                        'controller' => 'adfabgameadmin',
                                        'action'     => 'leaderboard',
                                        'gameId'     => 0
                                    ),
                                ),
                                'may_terminate' => true,
                                'child_routes' => array(
                                    'pagination' => array(
                                        'type'    => 'Segment',
                                        'options' => array(
                                            'route'    => '[:p]',
                                            'defaults' => array(
                                                'controller' => 'adfabgameadmin',
                                                'action'     => 'leaderboard',
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                            'quiz-question-list' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/quiz-question-list/:quizId',
                                    'defaults' => array(
                                        'controller' => 'adfabgame_admin_quiz',
                                        'action'     => 'listQuestion',
                                        'quizId'     => 0
                                    ),
                                ),
                            ),
                            'quiz-question-add' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/quiz-question-add/:quizId',
                                    'defaults' => array(
                                        'controller' => 'adfabgame_admin_quiz',
                                        'action'     => 'addQuestion',
                                        'quizId'     => 0
                                    ),
                                ),
                            ),
                            'quiz-question-edit' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/quiz-question-edit/:questionId',
                                    'defaults' => array(
                                        'controller' => 'adfabgame_admin_quiz',
                                        'action'     => 'editQuestion',
                                        'questionId'     => 0
                                    ),
                                ),
                            ),
                            'quiz-question-remove' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/quiz-question-remove/:questionId',
                                    'defaults' => array(
                                        'controller' => 'adfabgame_admin_quiz',
                                        'action'     => 'removeQuestion',
                                        'questionId'     => 0
                                    ),
                                ),
                            ),
                            'download' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/download/:gameId',
                                    'defaults' => array(
                                        'controller' => 'adfabgameadmin',
                                        'action'     => 'download',
                                        'gameId'     => 0
                                    ),
                                ),
                            ),
                            'edit' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/edit/:gameId',
                                    'defaults' => array(
                                        'controller' => 'adfabgameadmin',
                                        'action'     => 'edit',
                                        'gameId'     => 0
                                    ),
                                ),
                            ),
                            'remove' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/remove/:gameId',
                                    'defaults' => array(
                                        'controller' => 'adfabgameadmin',
                                        'action'     => 'remove',
                                        'gameId'     => 0
                                    ),
                                ),
                            ),

                            'prize-category-list' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/prize-category-list',
                                    'defaults' => array(
                                        'controller'         => 'adfabgame_admin_prizecategory',
                                        'action'             => 'list',
                                    ),
                                ),
                            ),

                            'prize-category-add' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/prize-category-add/:prizeCategoryId',
                                    'defaults' => array(
                                        'controller'         => 'adfabgame_admin_prizecategory',
                                        'action'             => 'add',
                                        'prizeCategoryId'    => 0
                                    ),
                                ),
                            ),

                            'prize-category-edit' => array(
                                'type' => 'Segment',
                                'options' => array(
                                    'route' => '/prize-category-edit/:prizeCategoryId',
                                    'defaults' => array(
                                        'controller'         => 'adfabgame_admin_prizecategory',
                                        'action'             => 'edit',
                                        'prizeCategoryId'    => 0
                                    ),
                                ),
                            ),
                        		
                        	'create-treasurehunt' => array(
                       			'type' => 'Segment',
                   				'options' => array(
                        			'route' => '/create-treasurehunt/:treasureHuntId',
                        			'defaults' => array(
           								'controller'         => 'adfabgame_admin_treasurehunt',
                        				'action'             => 'createTreasureHunt',
                        				'treasureHuntId'    => 0
                       				),
                   				),
                       		),
                        	'edit-treasurehunt' => array(
                       			'type' => 'Segment',
                   				'options' => array(
               						'route' => '/edit-treasurehunt/:gameId',
                        			'defaults' => array(
                       					'controller'         => 'adfabgame_admin_treasurehunt',
           								'action'             => 'editTreasureHunt',
               							'gameId'    => 0
                        			),
                   				),
                       		),
                        		'treasurehunt-step-list' => array(
                        			'type' => 'Segment',
                        			'options' => array(
                        				'route' => '/treasurehunt-step-list/:gameId[/:filter][/:p]',
                        				'defaults' => array(
                       						'controller'   => 'adfabgame_admin_treasurehunt',
                       						'action'       => 'listStep',
                       						'gameId'	   => 0,
                       						'filter'	   => 'DESC'
                   						),
                  						'constraints' => array(
                  							'filter' => '[a-zA-Z][a-zA-Z0-9_-]*',
                   						),
                       				),
                        		),
                        		'treasurehunt-step-add' => array(
                        			'type' => 'Segment',
                        			'options' => array(
                       					'route' => '/treasurehunt-step-add/:gameId',
                   						'defaults' => array(
                   							'controller' => 'adfabgame_admin_treasurehunt',
                   							'action'     => 'addStep',
                   							'gameId'     => 0
                        				),
                        			),
                        		),
                        		'treasurehunt-step-edit' => array(
                        			'type' => 'Segment',
                        			'options' => array(
                        				'route' => '/treasurehunt-step-edit/:gameId/:stepId',
                   						'defaults' => array(
               								'controller' => 'adfabgame_admin_treasurehunt',
               								'action'     => 'editStep',
                        					'gameId'     => 0,
                   							'stepId'     => 0
                   						),
                       				),
                        		),
                        		'treasurehunt-step-remove' => array(
                        			'type' => 'Segment',
                        			'options' => array(
                        				'route' => '/treasurehunt-step-remove/:stepId',
                   						'defaults' => array(
               								'controller' => 'adfabgame_admin_treasurehunt',
               								'action'     => 'removeStep',
                        					'stepId'     => 0
                        				),
                        			),
                        		),
                        	'treasure-hunt-areapicker' => array(
                       			'type' => 'Segment',
                   				'options' => array(
               						'route' => '/treasure-hunt-areapicker',
                        			'defaults' => array(
                       					'controller'         => 'adfabgame_admin_treasurehunt',
           								'action'             => 'areapicker',
               						),
                  				),
                      		),
                        ),
                    ),
                ),
            ),
        ),
    ),

    'navigation' => array(
        'default' => array(
            'adfabgame' => array(
                'label' => 'Jeux concours',
                'route' => 'jeuxconcours',
                'pages' => array(
                    'quiz' => array(
                        'label' => 'Quiz',
                        'route' => 'quiz',
                    ),
                    'quiz_play' => array(
                        'label' => 'Quiz',
                        'route' => 'quiz/play',
                    ),
                    'quiz_result' => array(
                        'label' => 'Quiz',
                        'route' => 'quiz/result',
                    ),
                    'quiz_bounce' => array(
                        'label' => 'Quiz',
                        'route' => 'quiz/bounce',
                    ),
                    'quiz_terms' => array(
                        'label' => 'Quiz',
                        'route' => 'quiz/terms',
                    ),
                    'lottery' => array(
                        'label' => 'Tirage au sort',
                        'route' => 'lottery',
                    ),
                    'lottery_result' => array(
                        'label' => 'Tirage au sort',
                        'route' => 'lottery/result',
                    ),
                    'lottery_bounce' => array(
                        'label' => 'Tirage au sort',
                        'route' => 'lottery/bounce',
                    ),
                    'lottery_terms' => array(
                        'label' => 'Tirage au sort',
                        'route' => 'lottery/terms',
                    ),
                    'instanwin' => array(
                        'label' => 'Instant gagnant',
                        'route' => 'instantwin',
                    ),
                    'instanwin_play' => array(
                        'label' => 'Instant gagnant',
                        'route' => 'instantwin/play',
                    ),
                    'instanwin_result' => array(
                        'label' => 'Instant gagnant',
                        'route' => 'instantwin/result',
                    ),
                    'instanwin_bounce' => array(
                        'label' => 'Instant gagnant',
                        'route' => 'instantwin/bounce',
                    ),
                    'instanwin_terms' => array(
                        'label' => 'Instant gagnant',
                        'route' => 'instantwin/terms',
                    ),
                    'postvote' => array(
                        'label' => 'Post & vote',
                        'route' => 'postvote',
                    ),
                    'postvote_play' => array(
                        'label' => 'Post & vote',
                        'route' => 'postvote/play',
                    ),
                    'postvote_preview' => array(
                        'label' => 'Post & vote',
                        'route' => 'postvote/play/preview',
                    ),
                    'postvote_result' => array(
                        'label' => 'Post & vote',
                        'route' => 'postvote/result',
                    ),
                    'postvote_post' => array(
                        'label' => 'Post & vote',
                        'route' => 'postvote/post',
                    ),
                    'postvote_list' => array(
                        'label' => 'Post & vote',
                        'route' => 'postvote/list',
                    ),
                    'postvote_bounce' => array(
                        'label' => 'Post & vote',
                        'route' => 'postvote/bounce',
                    ),
                ),
            ),
            array(
                'label' => 'Thématiques',
                'route' => 'thematiques/:id',
                'controller' => 'adfabgame_prizecategories',
                'action'     => 'index',
            ),
        ),
        'admin' => array(
            'adfabgame'     => array(
                'label'     => 'Les jeux',
                'route'     => 'zfcadmin/adfabgame/list',
                'resource'  => 'game',
                'privilege' => 'list',
                'pages' => array(
                    'list' => array(
                        'label'     => 'Liste des jeux',
                        'route'     => 'zfcadmin/adfabgame/list',
                        'resource'  => 'game',
                        'privilege' => 'list',
                    ),
                    'create-lottery' => array(
                        'label'     => 'Créer un tirage au sort',
                        'route'     => 'zfcadmin/adfabgame/create-lottery',
                        'resource'  => 'game',
                        'privilege' => 'add',
                    ),
                    'edit-lottery' => array(
                        'label'     => 'Editer un tirage au sort',
                        'route'     => 'zfcadmin/adfabgame/edit-lottery',
                        'privilege' => 'edit',
                    ),
                    'leaderboard-lottery' => array(
						'label' 	=> 'Participants',
						'route' 	=> 'zfcadmin/lottery/leaderboard',
						'privilege' => 'list',
					),
                    'create-quiz' => array(
                        'label'     => 'Créer un quiz',
                        'route'     => 'zfcadmin/adfabgame/create-quiz',
                        'resource'  => 'game',
                        'privilege' => 'add',
                    ),
                    'edit-quiz' => array(
                        'label'     => 'Editer un quiz',
                        'route'     => 'zfcadmin/adfabgame/edit-quiz',
                        'privilege' => 'edit',
                    ),
                    'leaderboard-quiz' => array(
						'label' 	=> 'Participants',
						'route' 	=> 'zfcadmin/quiz/leaderboard',
						'privilege' => 'list',
					),
                    'create-postvote' => array(
                        'label'     => 'Créer un Post & Vote',
                        'route'     => 'zfcadmin/adfabgame/create-postvote',
                        'resource'  => 'game',
                        'privilege' => 'add',
                    ),
                    'edit-postvote' => array(
                        'label'     => 'Editer un Post & Vote',
                        'route'     => 'zfcadmin/adfabgame/edit-postvote',
                        'privilege' => 'edit',
                    ),
                    'leaderboard-postvote' => array(
						'label' 	=> 'Participants',
						'route' 	=> 'zfcadmin/postvote/leaderboard',
						'privilege' => 'list',
					),
                    'create-instantwin' => array(
                        'label'     => 'Créer un instant gagnant',
                        'route'     => 'zfcadmin/adfabgame/create-instantwin',
                        'resource'  => 'game',
                        'privilege' => 'add',
                    ),
                    'edit-instantwin' => array(
                        'label'     => 'Editer un instant gagnant',
                        'route'     => 'zfcadmin/adfabgame/edit-instantwin',
                        'privilege' => 'edit',
                    ),
                    'leaderboard-instantwin' => array(
						'label' 	=> 'Participants',
						'route' 	=> 'zfcadmin/instantwin/leaderboard',
						'privilege' => 'list',
					),
                    'quiz-question-list' => array(
                        'label'     => 'Liste des questions',
                        'route'     => 'zfcadmin/adfabgame/quiz-question-list',
                        'privilege' => 'list',
                        'pages' => array(
                            'quiz-question-add' => array(
                            	'label'     => 'Ajouter des questions',
                            	'route'     => 'zfcadmin/adfabgame/quiz-question-add',
                            	'privilege' => 'add',
                            ),
                            'quiz-question-edit' => array(
	                            'label'     => 'Editer une question',
	                            'route'     => 'zfcadmin/adfabgame/quiz-question-edit',
	                            'privilege' => 'edit',
                            ),
                        ),
                    ),
                    'list-prizecategory' => array(
                        'label'     => 'Gérer les catégories de gain',
                        'route'     => 'zfcadmin/adfabgame/prize-category-list',
                        'resource'  => 'game',
                        'privilege' => 'prizecategory_list',
                    ),
                    /*
                    'list-postvotemod' => array(
                        'label'     => 'Posts en attente de modération',
                        'route'     => 'zfcadmin/adfabgame/postvote-mod-list',
                        'resource'  => 'game',
                        'privilege' => 'list',
                    ),
                    */
                    'instantwin-occurence-list' => array(
                        'label'     => 'Liste des instant gagnants',
                        'route'     => 'zfcadmin/adfabgame/instantwin-occurrence-list',
                        'privilege' => 'list',
                        'pages' 	=> array(
                            'instantwin-occurrence-add' => array(
                                'label'     => 'Créer un instant gagnant',
                                'route'     => 'zfcadmin/adfabgame/instantwin-occurrence-add',
                                'privilege' => 'add',
                            ),
                            'instantwin-occurrence-edit' => array(
                                'label'     => 'Editer un instant gagnant',
                                'route'     => 'zfcadmin/adfabgame/instantwin-occurrence-edit',
                                'privilege' => 'edit',
                            ),
                        ),
                    ),
                    'postvote-form' => array(
                    	'label'     => 'Options du Post & vote',
                        'route'     => 'zfcadmin/adfabgame/postvote-form',
                        'privilege' => 'list',
                    ),
                		
                	'create-treasurehunt' => array(
               			'label'     => 'Créer une chasse au trésor',
           				'route'     => 'zfcadmin/adfabgame/create-treasurehunt',
           				'resource'  => 'game',
           				'privilege' => 'add',
               		),
                ),
            ),
        ),
    )
);
