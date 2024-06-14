<?php

namespace App\Repository;

use App\Model\Media;
use Core\Repository\Repository;

class MediaRepository extends Repository
{
  public function getTableName(): string
  {
    return 'media'; //retourne le nom de la table
  }

  /**
   * Methode qui permet de récupérer tous les prix d'une pizza par son id avec sa taille associée
   * @param int $pizza_id
   * @return array
   */
  public function getMediaById(int $logement_id): array
  {
    //on déclare un tableau vide
    $array_result = [];

    //on crée notre requête sql
    $q = sprintf(
      'SELECT *
      FROM %s
      WHERE `logement_id` = :id',
      $this->getTableName()
    );

    //on prépare la requête
    $stmt = $this->pdo->prepare($q);

    //on verifie que la requête est bien exécutée
    if (!$stmt) return $array_result;

    //on execute en passant les paramètres (id de la pizza)
    $stmt->execute(['id' => $logement_id]);

    //on recupere les résultats  $row_data on met le nom que l'on veut
    while ($row_data = $stmt->fetch()) {
      //à chaque passage de la boucle on instancie un objet price
      $array_result[] = new Media($row_data);
    }

    //on retourne le tableau fraichement rempli
    return $array_result;
  }
}
