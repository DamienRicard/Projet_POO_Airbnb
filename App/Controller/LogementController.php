<?php

namespace App\Controller;

use Core\View\View;
use App\AppRepoManager;
use App\Model\Logement;
use Core\Form\FormError;
use Core\Form\FormResult;
use Core\Session\Session;
use Core\Controller\Controller;
use Laminas\Diactoros\ServerRequest;

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


  public function addLogement()
  {
      $view = new View('home/add_logement');
      $view->render();
  }

  
  public function addLogementForm(ServerRequest $request)
  {
    //on réceptionne les données du formulaire
    $data_form = $request->getParsedBody();
 
    //on instancie formResult pour stocker les messages d'erreurs
    $form_result = new FormResult();
    //on doit créer une instance de User
    $logement = new Logement();

    $title=$data_form['title'];
    $pays=$data_form['pays'];
    $ville=$data_form['ville'];
    $zip_code=$data_form['zip_code'];
    $size=$data_form['size'];
    $description=$data_form['description'];
    $nb_room=$data_form['nb_room'];
    $nb_bed=$data_form['nb_bed'];
    $nb_traveler=$data_form['nb_traveler'];
    $price=$data_form['price'];

    //on s'occupe de toutes les vérifications
    if (
      empty($title) ||
      empty($pays) ||
      empty($ville) ||
      empty($zip_code) ||
      empty($size) ||
      empty($description) ||
      empty($nb_room) ||
      empty($nb_bed) ||
      empty($nb_traveler) ||
      empty($price)
  
    )
    {
      $form_result->addError(new FormError('Veuillez renseigner tous les champs'));
    }
   
   
  }
    


}
