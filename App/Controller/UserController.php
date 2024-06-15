<?php

namespace App\Controller;

use Core\View\View;
use App\AppRepoManager;
use Core\Form\FormResult;
use Core\Controller\Controller;
use Laminas\Diactoros\ServerRequest;

class UserController extends Controller
{
    /**
   * methode qui récupère les données du formulaire et les envoie dans la BDD
   * @param ServerRequest $request
   */
  public function addReservationForm(ServerRequest $request)
  {
    $data_form = $request->getParsedBody();
    $result = new FormResult;

// on récup les données du formulaire, on stocke les inputs dans $price, $start...
    $price = $data_form['price_total'];
    $start = $data_form['date_start'];
    $end = $data_form['date_end'];
    $user = $data_form['user_id'];

// on recrée un tableau, nom_colonne_table => nom_donnée_stockée_dans_tableau_audessus
    $reservation_data = [
        'price_total' => $price,
        'date_start' => $start,
        'date_end' => $end,
        'user_id' => $user
    ];
    // données stockées dans un tableau, prêtes à être insérées var_dump($reservation_data);
    // données du formulaire var_dump($data_form); die;

    $reservation_data = AppRepoManager::getRm()->getReservationRepository()->insertReservation($reservation_data);

   self::redirect('home/mes_reservations/' . $user);
  }



  /**
   * Methode qui récupères les réservations par Id de l'utilisateur     todo: A FAIRE !!!!!!
   * @param int $id
   * @return array
   */
    public function getReservationById(int $id):array
    {
        //on déclare un tableau vide
        $array_result = [];

      //on crée la requête sql
      $q = sprintf(
        'SELECT * 
        FROM `%s` 
        WHERE `user_id` = :id
        ORDER BY status DESC',
        $this->getTableName()
      );

      //on prepare la requête
      $stmt = $this->pdo->prepare($q);

      //on exécute la requête
      if(!$stmt->execute(['id' => $id])) return $array_result;

      //on recupère les resultats
      while($row_data = $stmt->fetch()){
        $order = new Reservation($row_data);
        //on va hydrater pour remplir order_rows
        $order->order_rows = AppRepoManager::getRm()->getOrderRowRepository()->findOrderRowByOrder($order->id);

        //on remplie notre tableau
        $array_result[$order->status][] = $order;

      } 

      return $array_result;
    

       //on rend la vue
       $view = new View('home/mes_reservations');
       $view->render();
    }
}


     