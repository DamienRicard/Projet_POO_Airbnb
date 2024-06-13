<?php

namespace App\Controller;

use Core\View\View;
use App\AppRepoManager;
use Core\Controller\Controller;

class LogementController extends Controller
{

  /**
   * methode qui renvoie la vue de la liste des logements
   * @return void
   */
  public function getLogements(): void
  {
    //le controleur doit récupérer le tableau de logements via le repository, pour le donner à la vue
    $view_data = [
      'h1' => 'Tous les logements',
      'pizzas' =>  AppRepoManager::getRm()->getLogementRepository()->getAllLogements()
    ];

    $view = new View('home/logements');
    $view->render($view_data);
  }




}
