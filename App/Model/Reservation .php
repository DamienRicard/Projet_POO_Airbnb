<?php

namespace App\Model;
use Core\Model\Model;
use DateTime;

class Reservation extends Model
{
  public DateTime $date_start;
  public DateTime $date_end;
  public int $nb_adult;
  public int $nb_child;
  public int $price_total;
  public int $logement_id;
  public int $user_id;
}