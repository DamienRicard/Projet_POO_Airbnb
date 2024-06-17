<?php

namespace App\Controller;

use Core\View\View;
use App\AppRepoManager;
use Core\Form\FormResult;
use Core\Session\Session;
use Core\Controller\Controller;
use Laminas\Diactoros\ServerRequest;

class UserController extends Controller
{
    /**
     * methode qui récupère les données du formulaire et les envoie dans la BDD
     * @param ServerRequest $request
     */
    public function addReservationForm(ServerRequest $request)
    {
        $data_form = $request->getParsedBody();
        $result = new FormResult;

        // on récup les données du formulaire, on stocke les inputs dans $price, $start...
        $price = $data_form['price_total'];
        $start = $data_form['date_start'];
        $end = $data_form['date_end'];
        $user = $data_form['user_id'];

        // on recrée un tableau, nom_colonne_table => nom_donnée_stockée_dans_tableau_audessus
        $reservation_data = [
            'price_total' => $price,
            'date_start' => $start,
            'date_end' => $end,
            'user_id' => $user
        ];
        // données stockées dans un tableau, prêtes à être insérées var_dump($reservation_data);
        // données du formulaire var_dump($data_form); die;

        $reservation_data = AppRepoManager::getRm()->getReservationRepository()->insertReservation($reservation_data);

        self::redirect('/mes_reservations/' . $user);
    }



    public function ReservationsByUserId()
    {
        //le controleur doit récupérer le tableau de réservations via le repository, pour le donner à la vue
        $view_data = [
            'h1' => 'Mes réservations',
            'reservations' =>  AppRepoManager::getRm()->getReservationRepository()->ReservationsByUserId(Session::get(Session::USER)->id)
        ];
        $view = new View('home/mes_reservations');

        $view->render($view_data);
    }



    /**
     * methode qui permet d'ajouter un logement via les données du formulaire et les envoie dans la BDD
     * @param ServerRequest $request
     * @return void
     */
    public function addLogementForm(ServerRequest $request): void
    {
        $data_form = $request->getParsedBody();


        // on récup les données du formulaire, on stocke les inputs dans $price, $start...
        $user_id = $data_form['user_id'];
        $city = $data_form['city'];
        $country = $data_form['country'];
        $zipCode = $data_form['zip_code'];
        $price = $data_form['price_per_night'];
        $description = $data_form['description'];
        $title = $data_form['title'];
        $size = $data_form['size'];
        $nb_traveler = $data_form['nb_traveler'];
        $nb_room = $data_form['nb_room'];
        $nb_bath = $data_form['nb_bath'];
        $nb_bed = $data_form['nb_bed'];
        $type = $data_form['type_logement_id'];
        $phone = $data_form['phone'];
        $active =$data_form['is_active' = 1];
        //$equipement = $data_form['equipements'];





        // on recrée un tableau, nom_colonne_table => nom_donnée_stockée_dans_tableau_au_dessus
        $adress_data = [
            'adress' => $city,
            'country' => $country,
            'zip_code' => $zipCode,
            'phone' => $phone
        ];

        
        //on stocke l'id de la ligne de l'adresse qu'on vient d'insérer
        $adress_id = AppRepoManager::getRm()->getAdressRepository()->insertAdress($adress_data);


        $logement_data = [
            'user_id' => $user_id,
            'price_per_night' => $price,
            'description' => $description,
            'title' => $title,
            'taille' => $size,
            'nb_traveler' => $nb_traveler,
            'nb_room' => $nb_room,
            'nb_bath' => $nb_bath,
            'nb_bed' => $nb_bed,
            'is_active' => 1,
            'type_id' => $type,
            'address_id' => intval($adress_id)
        ];

        $logement_data = AppRepoManager::getRm()->getLogementRepository()->insertLogement($logement_data);
        

        // self::redirect('/home');

        //on redirige sur la page detail du logement

    }
}
