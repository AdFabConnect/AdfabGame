<?php

namespace AdfabGame\Controller\Admin;

use AdfabGame\Entity\Game;

use AdfabGame\Entity\InstantWin;
use AdfabGame\Entity\InstantWinOccurrence;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class InstantWinController extends AbstractActionController
{

    /**
     * @var GameService
     */
    protected $adminGameService;

    public function removeAction()
    {
        $service = $this->getAdminGameService();
        $gameId = $this->getEvent()->getRouteMatch()->getParam('gameId');
        if (!$gameId) {
            return $this->redirect()->toRoute('zfcadmin/adfabgame/list');
        }

        $game = $service->getGameMapper()->findById($gameId);
        $service->getGameMapper()->remove($game);
        $this->flashMessenger()->setNamespace('adfabgame')->addMessage('The game has been edited');

        return $this->redirect()->toRoute('zfcadmin/adfabgame/list');
    }

    public function createInstantWinAction()
    {
        $service = $this->getAdminGameService();
        $viewModel = new ViewModel();
        $viewModel->setTemplate('adfab-game/admin/instant-win/instantwin');

        $gameForm = new ViewModel();
        $gameForm->setTemplate('adfab-game/admin/game-form');

        $instantwin = new InstantWin();

        $form = $this->getServiceLocator()->get('adfabgame_instantwin_form');
        $form->bind($instantwin);
        $form->get('submit')->setLabel('Add');
        $form->setAttribute('action', $this->url()->fromRoute('zfcadmin/adfabgame/create-instantwin', array('gameId' => 0)));
        $form->setAttribute('method', 'post');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $data = array_merge(
                    $this->getRequest()->getPost()->toArray(),
                    $this->getRequest()->getFiles()->toArray()
            );
            $game = $service->create($data, $instantwin, 'adfabgame_instantwin_form');
            if ($game) {
                $this->flashMessenger()->setNamespace('adfabgame')->addMessage('The game was created');

                return $this->redirect()->toRoute('zfcadmin/adfabgame/list');
            }
        }
        $gameForm->setVariables(array('form' => $form));
        $viewModel->addChild($gameForm, 'game_form');

        return $viewModel->setVariables(array('form' => $form));
    }

    public function editInstantWinAction()
    {
        $service = $this->getAdminGameService();
        $gameId = $this->getEvent()->getRouteMatch()->getParam('gameId');

        if (!$gameId) {
            return $this->redirect()->toRoute('zfcadmin/adfabgame/create-instantwin');
        }

        $game = $service->getGameMapper()->findById($gameId);
        $viewModel = new ViewModel();
        $viewModel->setTemplate('adfab-game/admin/instant-win/instantwin');

        $gameForm = new ViewModel();
        $gameForm->setTemplate('adfab-game/admin/game-form');

        $form   = $this->getServiceLocator()->get('adfabgame_instantwin_form');
        $form->setAttribute('action', $this->url()->fromRoute('zfcadmin/adfabgame/edit-instantwin', array('gameId' => $gameId)));
        $form->setAttribute('method', 'post');
        $form->get('submit')->setLabel('Edit');

        $gameOptions = $this->getAdminGameService()->getOptions();
        $gameStylesheet = $gameOptions->getMediaPath() . '/' . 'stylesheet_'. $game->getId(). '.css';
        if (is_file($gameStylesheet)) {
            $values = $form->get('stylesheet')->getValueOptions();
            $values[$gameStylesheet] = 'Style personnalisé de ce jeu';

            $form->get('stylesheet')->setAttribute('options', $values);
        }

        $form->bind($game);

        if ($this->getRequest()->isPost()) {
            $data = array_merge(
                    $this->getRequest()->getPost()->toArray(),
                    $this->getRequest()->getFiles()->toArray()
            );
            $result = $service->edit($data, $game, 'adfabgame_instantwin_form');

            if ($result) {
                return $this->redirect()->toRoute('zfcadmin/adfabgame/list');
            }
        }

        $gameForm->setVariables(array('form' => $form));
        $viewModel->addChild($gameForm, 'game_form');

        return $viewModel->setVariables(array('form' => $form));
    }

    public function listOccurrenceAction()
    {
        $service 	= $this->getAdminGameService();
        $gameId 	= $this->getEvent()->getRouteMatch()->getParam('gameId');
        $filter		= $this->getEvent()->getRouteMatch()->getParam('filter');

        if (!$gameId) {
            return $this->redirect()->toRoute('zfcadmin/adfabgame/list');
        }

        //$instantwin = $service->getGameMapper()->findById($gameId);
        $occurrences = $service->getInstantWinOccurrenceMapper()->findByGameId($gameId, array('occurrence_date' => $filter));

        if (is_array($occurrences)) {
            $paginator = new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\ArrayAdapter($occurrences));
            $paginator->setItemCountPerPage(50);
            $paginator->setCurrentPageNumber($this->getEvent()->getRouteMatch()->getParam('p'));
        } else {
            $paginator = $occurrences;
        }

        return new ViewModel(
            array(
                'occurrences' => $paginator,
                'gameId' 	  => $gameId,
                'filter'	  => $filter,
            )
        );
    }

    public function addOccurrenceAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setTemplate('adfab-game/admin/instant-win/occurrence');
        $service = $this->getAdminGameService();
        $gameId = $this->getEvent()->getRouteMatch()->getParam('gameId');
        if (!$gameId) {
            return $this->redirect()->toRoute('zfcadmin/adfabgame/list');
        }

        $form = $this->getServiceLocator()->get('adfabgame_instantwinoccurrence_form');
        $form->get('submit')->setAttribute('label', 'Add');
        $form->setAttribute('action', $this->url()->fromRoute('zfcadmin/adfabgame/instantwin-occurrence-add', array('gameId' => $gameId)));
        $form->setAttribute('method', 'post');
        $form->get('instant_win_id')->setAttribute('value', $gameId);

        $occurrence = new InstantWinOccurrence();
        $form->bind($occurrence);

        if ($this->getRequest()->isPost()) {
            $data = array_merge(
                    $this->getRequest()->getPost()->toArray(),
                    $this->getRequest()->getFiles()->toArray()
            );

            $occurrence = $service->createOccurrence($data);
            if ($occurrence) {
                // Redirect to list of games
                $this->flashMessenger()->setNamespace('adfabgame')->addMessage('The occurrence was created');

                return $this->redirect()->toRoute('zfcadmin/adfabgame/instantwin-occurrence-list', array('gameId'=>$gameId));
            }
        }

        return $viewModel->setVariables(
            array(
                'form' => $form,
                'gameId' => $gameId,
                'occurrence_id' => 0,
                'title' => 'Add occurrence',
            )
        );
    }

    public function editOccurrenceAction()
    {
        $service = $this->getAdminGameService();
        $viewModel = new ViewModel();
        $viewModel->setTemplate('adfab-game/admin/instant-win/occurrence');

        $gameId = $this->getEvent()->getRouteMatch()->getParam('gameId');
        /*if (!$gameId) {
            return $this->redirect()->toRoute('zfcadmin/adfabgame/list');
        }*/

        $occurrenceId = $this->getEvent()->getRouteMatch()->getParam('occurrenceId');
        if (!$occurrenceId) {
            return $this->redirect()->toRoute('zfcadmin/adfabgame/list');
        }
        $occurrence   = $service->getInstantWinOccurrenceMapper()->findById($occurrenceId);
        $instantwinId     = $occurrence->getInstantWin()->getId();

        $form = $this->getServiceLocator()->get('adfabgame_instantwinoccurrence_form');
        $form->get('submit')->setAttribute('label', 'Add');
        $form->get('instant_win_id')->setAttribute('value', $instantwinId);

        $form->bind($occurrence);

        if ($this->getRequest()->isPost()) {
            $data = array_merge(
                    $this->getRequest()->getPost()->toArray(),
                    $this->getRequest()->getFiles()->toArray()
            );
            $occurrence = $service->updateOccurrence($data, $occurrence);
            if ($occurrence) {
                // Redirect to list of games
                $this->flashMessenger()->setNamespace('adfabgame')->addMessage('The occurrence was created');

                return $this->redirect()->toRoute('zfcadmin/adfabgame/instantwin-occurrence-list', array('gameId'=>$instantwinId));
            }
        }

        return $viewModel->setVariables(
            array(
                'form' => $form,
                'gameId' => $instantwinId,
                'occurrence_id' => $occurrenceId,
                'title' => 'Edit occurrence',
                'gameId' => $gameId,
            )
        );
    }

    public function removeOccurrenceAction()
    {
        $service = $this->getAdminGameService();
        $occurrenceId = $this->getEvent()->getRouteMatch()->getParam('occurrenceId');
        if (!$occurrenceId) {
            return $this->redirect()->toRoute('zfcadmin/adfabgame/list');
        }
        $occurrence   = $service->getInstantWinOccurrenceMapper()->findById($occurrenceId);
        $instantwinId = $occurrence->getInstantWin()->getId();

        $service->getInstantWinOccurrenceMapper()->remove($occurrence);
        $this->flashMessenger()->setNamespace('adfabgame')->addMessage('The occurrence was created');

        return $this->redirect()->toRoute('zfcadmin/adfabgame/instantwin-occurrence-list', array('gameId'=>$instantwinId));
    }

    public function leaderboardAction()
    {
        $gameId         = $this->getEvent()->getRouteMatch()->getParam('gameId');
        $game           = $this->getAdminGameService()->getGameMapper()->findById($gameId);

        $entries = $this->getAdminGameService()->getEntryMapper()->findBy(array('game' => $game));

        if (is_array($entries)) {
            $paginator = new \Zend\Paginator\Paginator(new \Zend\Paginator\Adapter\ArrayAdapter($entries));
            $paginator->setItemCountPerPage(10);
            $paginator->setCurrentPageNumber($this->getEvent()->getRouteMatch()->getParam('p'));
        } else {
            $paginator = $entries;
        }

        return array(
                'entries' => $paginator,
                'game' => $game,
                'gameId' => $gameId
        );
    }

    public function downloadAction()
    {
        // magically create $content as a string containing CSV data
        $gameId         = $this->getEvent()->getRouteMatch()->getParam('gameId');
        $game           = $this->getAdminGameService()->getGameMapper()->findById($gameId);
        //$service        = $this->getLeaderBoardService();
        //$leaderboards   = $service->getLeaderBoardMapper()->findBy(array('game' => $game));

        $entries = $this->getAdminGameService()->getEntryMapper()->findBy(array('game' => $game,'winner' => 1));

        $content        = "\xEF\xBB\xBF"; // UTF-8 BOM
        $content       .= "ID;Pseudo;Nom;Prenom;E-mail;Optin partenaire;A Gagné ?;Date - H\n";
        foreach ($entries as $e) {
            $content   .= $e->getUser()->getId()
            . ";" . $e->getUser()->getUsername()
            . ";" . $e->getUser()->getLastname()
            . ";" . $e->getUser()->getFirstname()
            . ";" . $e->getUser()->getEmail()
            . ";" . $e->getUser()->getOptinPartner()
            . ";" . $e->getWinner()
            . ";" . $e->getCreatedAt()->format('Y-m-d H:i:s')
            ."\n";
        }

        $response = $this->getResponse();
        $headers = $response->getHeaders();
        $headers->addHeaderLine('Content-Encoding: UTF-8');
        $headers->addHeaderLine('Content-Type', 'text/csv; charset=UTF-8');
        $headers->addHeaderLine('Content-Disposition', "attachment; filename=\"leaderboard.csv\"");
        $headers->addHeaderLine('Accept-Ranges', 'bytes');
        $headers->addHeaderLine('Content-Length', strlen($content));

        $response->setContent($content);

        return $response;
    }

    public function getAdminGameService()
    {
        if (!$this->adminGameService) {
            $this->adminGameService = $this->getServiceLocator()->get('adfabgame_instantwin_service');
        }

        return $this->adminGameService;
    }

    public function setAdminGameService(AdminGameService $adminGameService)
    {
        $this->adminGameService = $adminGameService;

        return $this;
    }
}