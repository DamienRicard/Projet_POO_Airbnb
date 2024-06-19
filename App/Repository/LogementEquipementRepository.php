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
      "INSERT INTO %s (logement_id, equipement_id) 
      VALUES (:logement_id, :equipement_id)",
      $this->getTableName()
    );

    //on prépare la requete
    $stmt = $this->pdo->prepare($q);

    //on vérifie si la requete s'est bien préparée
    if(!$stmt) return false;

    //on execute la requete en bindant les paramètres
    $stmt->execute($data);

    //on regarde si au moins une ligne a été enregistrée
    return $stmt->rowCount() > 0;
    
  
  }
}