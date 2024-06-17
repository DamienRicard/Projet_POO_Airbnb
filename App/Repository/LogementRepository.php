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
      'SELECT l.id, l.title, l.price_per_night, l.taille, m.image_path
      FROM %1$s AS l
      INNER JOIN %2$s AS m ON l.`id` = m.`logement_id`
      WHERE l.`is_active` = 1 ;
      ',
      $this->getTableName(),  //correspond au %1$s
      //appRepoManager renvoie au fichier AppRepoManager.php
      AppRepoManager::getRm()->getMediaRepository()->getTableName()  //correspond au %2$s
    );

    //on peut directement executer la requête
    $stmt = $this->pdo->query($query);
    //on vérifei que la requête est bien exécutée
    if (!$stmt) return $array_result;
    //on récupère les données que l'on met dans notre tableau
    while ($row_data = $stmt->fetch()) {
      //à chaque passage de la boucle on instancie un objet Logement, à chaque passage de la boucle on met les données dans le tableau
      $logement = new Logement($row_data);
      $logement->medias[] = $row_data['image_path'];
      $array_result[] = $logement;
    }
    return $array_result;
  }



  /**
   * methode qui permet de récupérer un logement grâce à son id
   * @param int $logement_id
   * @return ?Logement
   */
  public function getLogementById(int $logement_id): ?Logement
  {
    //on crée la requête sql
    $q = sprintf(
      'SELECT * FROM %s WHERE `id` = :id', //le :id est comme un espace réservé pour une valeur que l'on va fournir ultérieurement.
      $this->getTableName()
    );

    //on prépare la requête
    $stmt = $this->pdo->prepare($q);
    //on verifie que la requête est bien préparée
    if (!$stmt) return null;

    //on execute en passant les paramètres
    $stmt->execute(['id' => $logement_id]); // id car :id est dans la requête

    //on récupère le résultat dans un tableau associatif
    $result = $stmt->fetch();

    //si je n'ai pas de résultat je retourne null
    if (!$result) return null;

    //si j'ai un résultat j'instancie un objet Logement
    $logement = new Logement($result);

    //on va hydrater le type du logement dans l'objet Logement. ($logement->"type_logement_id" car c'est sur cette propriété que les 2tables sont liées)
    $logement->type_logement = AppRepoManager::getRm()->getTypeLogementRepository()->getTypeLogementByLogementId($logement->type_logement_id);

    //on va hydrater le type du logement dans l'objet Logement. ($logement->"type_logement_id" car c'est sur cette propriété que les 2tables sont liées)
    $logement->medias = AppRepoManager::getRm()->getMediaRepository()->getMediaById($logement_id);

    //je retourne l'objet Logement
    return $logement;
  }



  /**
   * methode qui permet d'insérer un logement
   */
  public function insertLogement(array $data)
  {
    $q = sprintf(
      "INSERT INTO %s (user_id, price_per_night, nb_room, nb_bed, nb_traveler, taille, description, title, is_active, type_id, adress_id)
        VALUES (:user_id, :price_per_night, :nb_rooms, :nb_bed, :nb_traveler, :taille, :description, :title, :is_active , :type_id, :adress_id) ",
      $this->getTableName()
    );

    $stmt = $this->pdo->prepare($q);

    if (!$stmt) return false;

    $stmt->execute($data);
  }
}
