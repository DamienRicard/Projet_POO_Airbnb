<?php

namespace App\Controller;

use Core\View\View;
use App\AppRepoManager;
use Core\Session\Session;
use Core\Controller\Controller;

class LogementController extends Controller
{
  /**
   * methode qui renvoie la vue de la page d'accueil
   * @return void
   */
  public function home()
  {
    //préparation des données à transmettre à la vue
    $view_data = [
      'title' => 'Accueil',
      'logement_list' => [
        'Margherita',
        'Hawaiana',
        'Napolitana'
      ]
    ];

    $view = new View('home/logements');
    $view->render($view_data);
  }


  /**
   * methode qui renvoie la vue de la liste des logements
   * @return void
   */
  public function getLogements(): void
  {
    //le controleur doit récupérer le tableau de logements via le repository, pour le donner à la vue
    $view_data = [
      'h1' => 'Tous les logements',
      'logements' =>  AppRepoManager::getRm()->getLogementRepository()->getAllLogements()
    ];

    $view = new View('home/index');
    $view->render($view_data);
  }


  public function getLogementById(int $id): void
  {
    $view_data = [
      'logement' => AppRepoManager::getRm()->getLogementRepository()->getLogementById($id),
      'form_result' => Session::get(Session::FORM_RESULT),
      'form_success' => Session::get(Session::FORM_SUCCESS),
    ];

    $view = new View('home/logement_detail');
    $view->render($view_data);
  }


}
