<?php

namespace App\Repository;

use Core\Repository\Repository;

class LogementEquipementRepository extends Repository
{
  public function getTableName(): string
  {
    return 'logement_equipement'; //retourne le nom de la table
  }



  /**
   * méthode qui permet d'insérer des equipements via la table LogementEquipement
   * @param array $data
   * 
   */
  public function addEquipementByLogementEquipement(array $data)
  {
    $q = sprintf(
      "INSERT INTO %s 
      (
        logement_id,
        equipement_id
      )VALUES (
        :logement_id,
        :equipement_id
      )
      ",
      $this->getTableName()
    );

    $stmt = $this->pdo->prepare($q);

    if (!$stmt) return false;

    $stmt->execute($data);
    
  
  }
}