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
  public int $Taille;

  public int $type_logement_id;
  public int $user_id;
  public int $adress_id;

  //on crée une propriété d'association pour stocker l'utilisateur, pour mettre en relation avec la foreign key
  public User $user;
  public TypeLogement $type_logement;
  public Adress $adress;

  public array $medias;
}
