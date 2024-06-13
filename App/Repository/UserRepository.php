<?php

namespace App\Repository;

use Core\Repository\Repository;

class UserRepository extends Repository
{
  public function getTableName(): string
  {
    return 'user'; //retourne le nom de la table
  }
}