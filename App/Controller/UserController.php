<?php

namespace App\Controller;

use Core\View\View;
use App\AppRepoManager;
use Core\Form\FormError;
use Core\Form\FormResult;
use Core\Session\Session;
use Core\Form\FormSuccess;
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



    public function myReservationsByUserId()
    {
        //le controleur doit récupérer le tableau de réservations via le repository, pour le donner à la vue
        $view_data = [
            //la clé "reservations" je mets le nom que je veux mais on le retrouvera dans la vue !!!
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
        $form_result = new FormResult;

var_dump($_FILES);die;
        // on récup les données du formulaire, on stocke les inputs dans $adress $zipCode...
        $adress = $data_form['adress'] ?? '';
        $zipCode = $data_form['zip_code'] ?? '';
        $city = $data_form['city'] ?? '';
        $country = $data_form['country'] ?? '';
        $phone = $data_form['phone'] ?? '';
        $title = $data_form['title'] ?? '';
        $description = $data_form['description'] ?? '';
        $price = $data_form['price_per_night'] ?? 0;
        $nb_room = $data_form['nb_room'] ?? 0;
        $nb_bed = $data_form['nb_bed'] ?? 0;
        $nb_bath = $data_form['nb_bath'] ?? 0;
        $nb_traveler = $data_form['nb_traveler'] ?? 0;
        $type = $data_form['type_logement_id'] ?? 0;
        $user_id = $data_form['user_id'] ?? 0;
        $size = $data_form['size'] ?? 0;
        $equipements = $data_form['equipements']; //récupère tous les équipements envoyés par le formulaire
        


        // on recrée un tableau, 'nom_colonne_denotreTable' => $nom_donné_dans_tableau_au_dessus
        // données envoyées dans la table Adresse de la BDD
        $adress_data = [
            'adress' => $adress,
            'zip_code' => $zipCode,
            'city' => $city,
            'country' => $country,
            'phone' => $phone
        ];
        //on stocke l'id de la ligne de l'adresse qu'on vient d'insérer
        $adress_id = AppRepoManager::getRm()->getAdressRepository()->insertAdress($adress_data); // recupère le last ID qui a été crée

        // données envoyées dans la table Adresse de la BDD
        //il faut que les clés (à gauche)correspondent exactement aux nom de la bdd, sinon elles ne sont pas prises en compte
        $logement_data = [
            'title' => $title,
            'description' => $description,
            'price_per_night' => $price,
            'nb_room' => $nb_room,
            'nb_bed' => $nb_bed,
            'nb_bath' => $nb_bath,
            'nb_traveler' => $nb_traveler,
            'is_active' => 1,
            'type_logement_id' => $type,
            'user_id' => $user_id,
            'adress_id' => intval($adress_id),
            'Taille' => $size,
        ];
        $logement_id = AppRepoManager::getRm()->getLogementRepository()->insertLogement($logement_data);


        // 
        foreach($equipements as $equipement) {
            
            $equipement_data = [
                'logement_id' => $logement_id,
                'equipement_id' => $equipement
            ];
            
            AppRepoManager::getRm()->getLogementEquipementRepository()->addEquipementByLogementEquipement($equipement_data);
           
//voir Papa pizza
//deplacer fichier tmp_name (serveur tempraire) vers dossier public/assets/images et si renvoie true : je recrée un tableau avec les infos qu'il me faut pour l'inserer dans la BDD
            //if ()
            // $media =[
            //    'image_path' => $image_path,
            //    'logement_id' => $logement_id
            // ];

          //  AppRepoManager::getRm()->getMediaRepository()->getMedia($media);
            










        }
      

        if (!$logement_data) {
            $form_result->addError(new FormError('Une erreur est survenue lors de l\'insertion du logement'));
        } else {
            $form_result->addSuccess(new FormSuccess('Le logement a bien été inséré'));
        }

        //on finit toujours les formulaires avec ce genre de check de messages (avec ServerRequest en paramètre de la fonction)
        //si on a des erreurs on les met en session pour les interpreter
        if ($form_result->hasErrors()) {
            Session::set(Session::FORM_RESULT, $form_result);
            //on redirige sur la page du formulaire
            self::redirect('/add_logement/' . $user_id);
        }

        //si on a des success on les met en session pour les interpreter
        if ($form_result->getSuccessMessage()) {
            Session::remove(Session::FORM_RESULT);
            Session::set(Session::FORM_SUCCESS, $form_result);
            //on redirige sur la page mes logements
            self::redirect('/');
        }
    
    }



    public function myLogementsByUserId()
    {
        //le controleur doit récupérer le tableau de logements via le repository, pour le donner à la vue

        $view_data = [
            //la clé "meslogements" je mets le nom que je veux mais on le retrouvera dans la vue !!!
            'meslogements' =>  AppRepoManager::getRm()->getLogementRepository()->LogementsByUserId(Session::get(Session::USER)->id)
        ];
        $view = new View('user/mes_logements');

        $view->render($view_data);

    }
}
