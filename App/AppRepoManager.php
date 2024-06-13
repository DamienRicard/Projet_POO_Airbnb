<?php

namespace App;

use App\Model\LogementEquipement;
use App\Repository\AdressRepository;
use App\Repository\EquipementRepository;
use App\Repository\FavorisRepository;
use App\Repository\LogementEquipementRepository;
use App\Repository\LogementRepository;
use App\Repository\MediaRepository;
use App\Repository\ReservationRepository;
use App\Repository\TypeLogementRepository;
use App\Repository\UserRepository;
use Core\Repository\RepositoryManagerTrait;

class AppRepoManager
{
  //on récupère le trait RepositoryManagerTrait
  use RepositoryManagerTrait;

  //on déclare une propriété privée qui va contenir une instance du repository, exemple: private Repository $Repository;
  private AdressRepository $adressRepository;
  private EquipementRepository $equipementRepository;
  private FavorisRepository $favorisRepository;
  private LogementEquipementRepository $logementEquipementRepository;
  private LogementRepository $logementRepository;
  private MediaRepository $mediaRepository;
  private ReservationRepository $reservationRepository;
  private TypeLogementRepository $typeLogementRepository;
  private UserRepository $userRepository;



  //on crée ensuite les getter pour accéder à la propriété privée
  //exemple: public function getRepository(): Repository
  //{
  //  return $this->Repository;
  //}

  public function AdressRepository(): AdressRepository
  {
    return $this->adressRepository;
  }

  public function EquipementRepository(): EquipementRepository
  {
    return $this->equipementRepository;
  }

  public function FavorisRepository(): FavorisRepository
  {
    return $this->favorisRepository;
  }

  public function LogementEquipementRepository(): LogementEquipementRepository
  {
    return $this->logementEquipementRepository;
  }

  public function LogementRepository(): LogementRepository
  {
    return $this->logementRepository;
  }

  public function MediaRepository(): MediaRepository
  {
    return $this->mediaRepository;
  }

  public function ReservationRepository(): ReservationRepository
  {
    return $this->reservationRepository;
  }

  public function TypeLogementRepository(): TypeLogementRepository
  {
    return $this->typeLogementRepository;
  }

  public function UserRepository(): UserRepository
  {
    return $this->userRepository;
  }


  //enfin, on declare un construct qui va instancier les repositories
  protected function __construct()
  {
    $config = App::getApp();
    //on instancie le repository
    //exemple: $this->Repository = new Repository($config);

    $this->adressRepository = new AdressRepository($config);
    $this->equipementRepository = new EquipementRepository($config);
    $this->favorisRepository = new FavorisRepository($config);
    $this->logementEquipementRepository = new LogementEquipementRepository($config);
    $this->logementRepository = new LogementRepository($config);
    $this->mediaRepository = new MediaRepository($config);
    $this->reservationRepository = new ReservationRepository($config);
    $this->typeLogementRepository = new TypeLogementRepository($config);
    $this->userRepository = new UserRepository($config);
  }
}
