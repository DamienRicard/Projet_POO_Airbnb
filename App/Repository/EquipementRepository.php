<?php

namespace App\Repository;

use Core\Repository\Repository;

class EquipementRepository extends Repository
{
  public function getTableName(): string
  {
    return 'equipement'; //retourne le nom de la table
  }
}