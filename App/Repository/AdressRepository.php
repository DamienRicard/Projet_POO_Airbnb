<?php

namespace App\Repository;

use Core\Repository\Repository;

class AdressRepository extends Repository
{
  public function getTableName(): string
  {
    return 'adress'; //retourne le nom de la table
  }



  public function insertAdress(array $data): ?int
    {
      //on crée la requete SQL
      $q = sprintf(
        'INSERT INTO `%s` (`adress`, `country`, `zip_code`, `phone`)
        VALUES (:adress, :country, :zip_code  , :phone)',
        $this->getTableName()
      );
  
      //on prépare la requete
      $stmt = $this->pdo->prepare($q);
  
      //on vérifie que la requete est bien préparée
      if (!$stmt) return null;
  
      //on execute la requete en passant les paramètres
      $stmt->execute($data);
  
      //on retourne l'id  de la ligne qu'on vient d'inserer
      return $this->pdo->lastInsertId();
    }
}