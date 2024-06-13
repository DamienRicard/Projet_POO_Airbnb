<?php

namespace App\Repository;

use App\AppRepoManager;
use App\Model\Logement;
use Core\Repository\Repository;

class LogementRepository extends Repository
{
  public function getTableName(): string
  {
    return 'logement'; //retourne le nom de la table
  }


  /**
   * methode qui récupère tous les logements
   * @return array
   */
  public function getAllLogements(): array
  {
    //on déclare un tableau vide
    $array_result = [];

    //on crée la requête sql
    //1$ et 2$ pour indiquer que c'est une jointure, 2 tables différentes. Avec sprintf on est obligé d'utiliser le %1$s (et %2$s si 2 tables)
    $query = sprintf(
      'SELECT l.id, l.title, l.description, l.price_per_night, l.nb_room, l.nb_bed, l.nb_bath, l.nb_traveler, l.is_active, tl.label
      FROM %1$s AS l           
      INNER JOIN %2$s AS tl on l.`type_logement_id` = tl.`id`
      WHERE l.`is_active` = 1 ;
      ',
      $this->getTableName(),  //correspond au %1$s
      //appRepoManager renvoie au fichier AppRepoManager.php
      AppRepoManager::getRm()->getTypeLogementRepository()->getTableName()  //correspond au %2$s
    );

    //on peut directement executer la requête
    $stmt = $this->pdo->query($query);
    //on vérifei que la requête est bien exécutée
    if (!$stmt) return $array_result;
    //on récupère les données que l'on met dans notre tableau
    while ($row_data = $stmt->fetch()) {
      //à chaque passage de la boucle on instancie un objet Logement, à chaque passage de la boucle on met les données dans le tableau
      $array_result[] = new Logement($row_data);
    }
    return $array_result;
  }










}
