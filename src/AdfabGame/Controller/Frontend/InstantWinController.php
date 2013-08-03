<?php

namespace AdfabGame\Controller\Frontend;

use AdfabGame\Entity\Entry;
use Zend\View\Model\ViewModel;

class InstantWinController extends GameController
{
    /**
     * @var leaderBoardService
     */
    protected $leaderBoardService;

    /**
     * @var gameService
     */
    protected $gameService;

    public function playAction()
    {
        $identifier = $this->getEvent()->getRouteMatch()->getParam('id');
        $user = $this->zfcUserAuthentication()->getIdentity();
        $sg = $this->getGameService();

        $game = $sg->checkGame($identifier);
        if (!$game || $game->isClosed()) {
            return $this->notFoundAction();
        }

        if (!$user) {
            $redirect = urlencode($this->url()->fromRoute('instantwin/play', array('id' => $game->getIdentifier()), array('force_canonical' => true)));

            return $this->redirect()->toUrl($this->url()->fromRoute('zfcuser/register') . '?redirect='.$redirect);
        }

        $viewModel = $this->buildView($game);
        $beforeLayout = $this->layout()->getTemplate();
        // je délègue la responsabilité du formulaire à AdfabUser, y compris dans sa gestion des erreurs
        $form = $this->forward()->dispatch('adfabuser_user', array('action' => 'address'));

        // TODO : suite au forward, le template de layout a changé, je dois le rétablir...
        $this->layout()->setTemplate($beforeLayout);
        // Le formulaire est validé, il renvoie true et non un ViewModel
        if (!($form instanceof \Zend\View\Model\ViewModel)) {
            return $this->redirect()->toUrl($this->url()->fromRoute('instantwin/result', array('id' => $identifier)));
        }

        if ($this->getRequest()->isPost()) {
            // En post, je reçois la maj du form pour les gagnants. Je n'ai pas à créer une nouvelle participation mais vérifier la précédente
            $lastEntry = $sg->getEntryMapper()->findLastInactiveEntryById($game, $user);
            if (!$lastEntry) {
                return $this->redirect()->toUrl($this->url()->fromRoute('instantwin', array('id' => $game->getIdentifier()), array('force_canonical' => true)));
            }
            $winner = $lastEntry->getWinner();
            // if not winner, I'm not authorized to call this page in POST mode.
            if (!$winner) {
                return $this->redirect()->toUrl($this->url()->fromRoute('instantwin', array('id' => $game->getIdentifier()), array('force_canonical' => true)));
            }

            // si la requete est POST et que j'arrive ici, c'est que le formulaire contient une erreur. Donc je prépare la vue formulaire sans le grattage
            //$viewModel->setTemplate('instant-win/winner/form');
        } else {
            // J'arrive sur le jeu, j'essaie donc de participer
            $entry = $sg->play($game, $user);
            if (!$entry) {
                // the user has already taken part of this game and the participation limit has been reached
                $this->flashMessenger()->addMessage('Vous avez déjà participé');

                return $this->redirect()->toUrl($this->url()->fromRoute('instantwin/result',array('id' => $identifier)));
            }

            // update the winner attribute in entry.
            $winner = $sg->IsInstantWinner($game, $user);
        }

        $viewModel->setVariables(array(
            'game' => $game,
            'winner' => $winner,
            'flashMessages' => $this->flashMessenger()->getMessages(),
        ));
        $viewModel->addChild($form, 'form');

        return $viewModel;
    }

    public function resultAction()
    {
    	$identifier = $this->getEvent()->getRouteMatch()->getParam('id');
        $user   = $this->zfcUserAuthentication()->getIdentity();
        $sg     = $this->getGameService();

        $statusMail = null;

        $game = $sg->checkGame($identifier);
        if (!$game || $game->isClosed()) {
            return $this->notFoundAction();
        }

        $secretKey = strtoupper(substr(sha1($user->getId().'####'.time()),0,15));
        $socialLinkUrl = $this->url()->fromRoute('instantwin', array('id' => $game->getIdentifier()), array('force_canonical' => true)).'?key='.$secretKey;
        // With core shortener helper
        $socialLinkUrl = $this->shortenUrl()->shortenUrl($socialLinkUrl);

        if (!$user) {
            $redirect = urlencode($this->url()->fromRoute('instantwin', array('id' => $game->getIdentifier()), array('force_canonical' => true)));

            return $this->redirect()->toUrl($this->url()->fromRoute('zfcuser/register') . '?redirect='.$redirect);
        }

        $lastEntry = $sg->getEntryMapper()->findLastInactiveEntryById($game, $user);
        if (!$lastEntry) {
            return $this->redirect()->toUrl($this->url()->fromRoute('instantwin', array('id' => $game->getIdentifier()), array('force_canonical' => true)));
        }

        $winner = $lastEntry->getWinner();

        $form = $this->getServiceLocator()->get('adfabgame_sharemail_form');
        $form->setAttribute('method', 'post');

        if ($this->getRequest()->isPost()) {
            $data = $this->getRequest()->getPost()->toArray();
            $form->setData($data);
            if ($form->isValid()) {
                $result = $this->getGameService()->sendShareMail($data, $game, $user);
                if ($result) {
                    $statusMail = true;
                }
            }
        }

        $viewModel = $this->buildView($game);
        $viewModel->setVariables(array(
            'statusMail'       => $statusMail,
            'game'             => $game,
            'winner'           => $winner,
            'flashMessages'    => $this->flashMessenger()->getMessages(),
            'form'             => $form,
            'socialLinkUrl'    => $socialLinkUrl,
            'secretKey'		   => $secretKey
        ));

        return $viewModel;
    }

    public function fbshareAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $identifier = $this->getEvent()->getRouteMatch()->getParam('id');
        $fbId = $this->params()->fromQuery('fbId');
        $user = $this->zfcUserAuthentication()->getIdentity();
        $sg = $this->getGameService();

        $game = $sg->checkGame($identifier);
        if (!$game) {
            return false;
        }
        $subscription = $sg->checkExistingEntry($game, $user);
        if (! $subscription) {
            return false;
        }
        if (!$fbId) {
            return false;
        }

        $sg->postFbWall($fbId, $game, $user);

        return true;

    }

    public function tweetAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $identifier = $this->getEvent()->getRouteMatch()->getParam('id');
        $tweetId = $this->params()->fromQuery('tweetId');
        $user = $this->zfcUserAuthentication()->getIdentity();
        $sg = $this->getGameService();

        $game = $sg->checkGame($identifier);
        if (!$game) {
            return false;
        }
        $subscription = $sg->checkExistingEntry($game, $user);
        if (! $subscription) {
            return false;
        }
        if (!$tweetId) {
            return false;
        }

        $sg->postTwitter($tweetId, $game, $user);

        return true;

    }

    public function googleAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $identifier = $this->getEvent()->getRouteMatch()->getParam('id');
        $googleId = $this->params()->fromQuery('googleId');
        $user = $this->zfcUserAuthentication()->getIdentity();
        $sg = $this->getGameService();

        $game = $sg->checkGame($identifier);
        if (!$game) {
            return false;
        }
        $subscription = $sg->checkExistingEntry($game, $user);
        if (! $subscription) {
            return false;
        }
        if (!$googleId) {
            return false;
        }

        $sg->postGoogle($googleId, $game, $user);

        return true;

    }

    public function getGameService()
    {
        if (!$this->gameService) {
            $this->gameService = $this->getServiceLocator()->get('adfabgame_instantwin_service');
        }

        return $this->gameService;
    }

    public function setGameService(GameService $gameService)
    {
        $this->gameService = $gameService;

        return $this;
    }

    public function getLeaderBoardService()
    {
        if (!$this->leaderBoardService) {
            $this->leaderBoardService = $this->getServiceLocator()->get('adfabgame_leaderboard_service');
        }

        return $this->leaderBoardService;
    }

    public function setLeaderBoardService(LeaderBoardService $leaderBoardService)
    {
        $this->leaderBoardService = $leaderBoardService;

        return $this;
    }
}
