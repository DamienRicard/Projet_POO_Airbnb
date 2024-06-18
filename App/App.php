<?php

namespace App;

use MiladRahimi\PhpRouter\Router;
use App\Controller\AuthController;
use App\Controller\HomeController;
use App\Controller\UserController;
use App\Controller\LogementController;
use Core\Database\DatabaseConfigInterface;
use MiladRahimi\PhpRouter\Exceptions\RouteNotFoundException;
use MiladRahimi\PhpRouter\Exceptions\InvalidCallableException;

class App implements DatabaseConfigInterface
{

  private static ?self $instance = null;
  //on crée une méthode public appelée au demarrage de l'appli dans index.php
  public static function getApp(): self
  {
    if (is_null(self::$instance)) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  //on crée une propriété privée pour stocker le routeur
  private Router $router;
  //méthode qui récupère les infos du routeur
  public function getRouter()
  {
    return $this->router;
  }

  private function __construct()
  {
    //on crée une instance de Router
    $this->router = Router::create();
  }

  //on a 3 méthodes à définir 
  // 1. méthode start pour activer le router
  public function start(): void
  {
    //on ouvre l'accès aux sessions
    session_start();
    //enregistrements des routes
    $this->registerRoutes();
    //démarrage du router
    $this->startRouter();
  }

  //2. méthode qui enregistre les routes
  private function registerRoutes(): void
  {
    //ON ENREGISTRE LES ROUTES ICI
    $this->router->get('/', [HomeController::class, 'home']);
    //INFO: si on veut renvoyer une vue à l'utilisateur => route en "get"
    //INFO: si on veut traiter des données d'un formulaire => route en "post"

    // PARTIE AUTHENTIFICATION
    $this->router->get('/inscription', [AuthController::class, 'registerForm']);
    $this->router->get('/connexion', [AuthController::class, 'loginForm']);
    $this->router->post('/register', [AuthController::class, 'register']);
    $this->router->post('/login', [AuthController::class, 'login']);
    $this->router->get('/logout', [AuthController::class, 'logout']);


    // PARTIE UTILISATEUR
    //route qui permet à l'utilisateur de faire une reservation via le formulaire
    $this->router->post('/reservation_form', [UserController::class, 'addReservationForm']);
    //route qui redirige vers la page ou l'utilisateur peut voir ses reservations
    $this->router->get('/mes_reservations/{id}', [UserController::class, 'myReservationsByUserId']);
    //route qui permet à l'utilisateur de mettre son logement en location via le formulaire
    $this->router->post('/mes_logements/{id}', [UserController::class, 'addLogementForm']);
    //route qui redirige vers la page ou l'utilisateur peut voir ses logements qu'il a mis en location
    $this->router->get('/mes_logements/{id}', [UserController::class, 'myLogementsByUserId']);


    //PARTIE LOGEMENTS
    $this->router->get('/', [LogementController::class, 'getLogements']);
    $this->router->get('/logement_detail/{id}', [LogementController::class, 'getLogementById']);
    $this->router->get('/add_logement', [LogementController::class, 'addLogement']);
    $this->router->post('/add_logement_form', [UserController::class, 'addLogementForm']);
  }

  //3. méthode qui démarre le router
  private function startRouter(): void
  {
    try {
      $this->router->dispatch();
    } catch (RouteNotFoundException $e) {
      echo $e;
    } catch (InvalidCallableException $e) {
      echo $e;
    }
  }

  public function getHost(): string
  {
    return DB_HOST;
  }

  public function getName(): string
  {
    return DB_NAME;
  }

  public function getUser(): string
  {
    return DB_USER;
  }

  public function getPass(): string
  {
    return DB_PASS;
  }
}
