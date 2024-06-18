<?php

namespace App\Repository;

use App\Model\Equipement;
use Core\Repository\Repository;

class EquipementRepository extends Repository
{
  public function getTableName(): string
  {
    return 'equipement'; //retourne le nom de la table
  }


  /**
   * methode qui récupère tous les équipements actifs rangés par label
   * @return array
   * @param int $label_id
   */
  public function getEquipementActiveBylabel(): array
  {
    //on crée un tableau vide
    $array_result = [];
    //on crée notre requête sql
    $q = sprintf(
      'SELECT * 
      FROM `%s`
      
      ORDER BY `label` ASC',
      $this->getTableName()
    );
    //on execute la requête
    $stmt = $this->pdo->query($q);
    //on verifie que la requête est bien exécutée
    if (!$stmt) return $array_result;
    //on recupère les données que l'on met dans notre tableau
    while ($row_data = $stmt->fetch()) {
      //dans mon tableau je crée une clé de row data category
      $array_result[$row_data['label']] []= new Equipement($row_data);
    }
      return $array_result;
  }


  
}