<?php

namespace App\Controller;

use Core\View\View;
use Core\Session\Session;
use Core\Controller\Controller;



class AuthController extends Controller
{
  /**
   * methode qui renvoie la vue du formulaire d'enregistrement
   * @return void
   * 
   */
  public function registerForm()
  {
    $view = new View('auth/inscription');
    $view_data = [
      'form_result' => Session::get(Session::FORM_RESULT)
    ];

    $view->render($view_data);
  }

}