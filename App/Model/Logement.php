<?php

namespace App\Model;
use Core\Model\Model;

class Logement extends Model
{
  public string $title;
  public string $description;
  public string $price_per_night;
  public int $nb_room;
  public int $nb_bed;
  public int $nb_bath;
  public int $nb_traveler;
  public bool $is_active;
  public string $type_logement;
  public int $user_id;
  public int $adress_id;
}