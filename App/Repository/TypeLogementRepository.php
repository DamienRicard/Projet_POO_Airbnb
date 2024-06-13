<?php

namespace App\Repository;

use Core\Repository\Repository;

class TypeLogementRepository extends Repository
{
  public function getTableName(): string
  {
    return 'type_logement'; //retourne le nom de la table
  }
}