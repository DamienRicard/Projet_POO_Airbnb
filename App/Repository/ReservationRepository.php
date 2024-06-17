<?php

namespace App\Repository;

use App\Model\Logement;
use Core\View\View;
use App\Model\Reservation;
use Core\Repository\Repository;

class ReservationRepository extends Repository
{
  public function getTableName(): string
  {
    return 'reservation'; //retourne le nom de la table
  }


  /**
   * methode
   */
  public function insertReservation(array $data)
  {
    $q = sprintf(
      "INSERT INTO %s (`price_total`,`date_start`, `date_end`, `user_id`) 
      VALUES (:price_total, :date_start, :date_end, :user_id)",
      $this->getTableName()
    );

    $stmt = $this->pdo->prepare($q);

    if (!$stmt) return false;

    $stmt->execute($data);
  }



  /**
   * methode qui permet de récupérer toutes les commandes d'un utilisateur
   * @param int $id
   * @return array
   */
  // public function findReservationByUser(int $id):array
  // {

  // }


  /**
   * methode qui affiche les reservations par Id
   * @param int $id
   * @return array car on veut un tableau de toutes les réservations (chaque réservations contient plusieurs données)
   */
  public function ReservationsByUserId(int $id): array
  {
    $array_result = [];

    $q = sprintf(
      'SELECT *
      FROM %s
      WHERE `user_id` = :id',
      $this->getTableName()
    );
    $stmt = $this->pdo->prepare($q);

    //on verifie que la requête est bien préparée
    if (!$stmt) return $array_result;

    //on execute la requête en passant les paramètres
    $stmt->execute(['id' => $id]);

    while ($row_data = $stmt->fetch()) {
      //a chaque tour de boucle on instancie un objet Réservation
      $reservation = new Reservation($row_data);

      //on stocke reservation dans le tableau
      $array_result[] = $reservation;
    }
    
    //on retourne l'objet Reservation
    return $array_result;
  }
}
