<?php

namespace App\Repository;

use App\AppRepoManager;
use App\Model\TypeLogement;
use Core\Repository\Repository;

class TypeLogementRepository extends Repository
{
  public function getTableName(): string
  {
    return 'type_logement'; //retourne le nom de la table
  }



  /**
   * méthode qui récupère le type de logement par son id
   * @param int $logement_id
   * @return array
   */
  public function getTypeLogementByLogementId($logement_id): ?TypeLogement
  {

    //on crée notre requête sql
    $q = sprintf(
      ' SELECT *
      FROM %s 
      WHERE id = :id',
      $this->getTableName()
    );

    //on prépare la requête
    $stmt = $this->pdo->prepare($q);

    //on verifie que la requête est bien exécutée
    if (!$stmt) return null;

    //on execute en passant les paramètres (id du logement)
    $stmt->execute(['id' => $logement_id]);

    $result = $stmt->fetch();

    if(!$result) return null;

    return new TypeLogement($result);
  }
}
