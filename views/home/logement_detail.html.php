<?php

use Core\Session\Session; ?>
<div class="container mt-5">
  <?php if (!$auth::isAuth()) $auth::redirect('/connexion') ?>

  <div class="card card-detail d-flex flex-column">

    <div class="d-flex justify-content-center">
      <?php foreach ($logement->media as $index => $media) : ?>
        <a href="/assets/images/<?= $media->image_path ?>" target="_blank">
          <img src="/assets/images/<?= $media->image_path ?>" class=" img" alt="Image du logement">
        </a>
      <?php endforeach; ?>
    </div>

    <div class="infos-equipements">
      <div class="card-body w-50">
        <h1 class="card-title"> <?= $logement->title ?> </h1>
        <p class="card-text"><?= $logement->description ?></p>
        <p class="card-text">Type de logement : <?= $logement->type_logement->label ?></p>
        <p class="card-text price">Prix : <span id="nightPrice" class="price1"><?= $logement->price_per_night ?> </span>€ / nuit </p>
        <p class="card-text">Taille du logement : <?= $logement->Taille ?> m² </p>
        <p class="card-text">Nombre de chambres : <?= $logement->nb_room ?> </p>
        <p class="card-text">Nombre de lits : <?= $logement->nb_bed ?> </p>
        <p class="card-text">Nombre de salles de bains : <?= $logement->nb_bath ?> </p>
        <p class="card-text">Nombre de voyageurs : <?= $logement->nb_traveler ?> </p>
      </div>
<div>
      <p>Equipements inclus dans ce logement :</p>
      <div class="equipements w-50 d-flex flex-row flex-wrap">
        
        <?php foreach ($logement->equipements as  $equipement) : ?>
          <div class="d-flex flex-row flex-wrap">
            <div class="badge d-flex rounded-pill align-items-center flex-row text-dark">
              <img style="width: 20px; height: 20px; fill: white" src="/assets/icons/icons/<?= $equipement->image_path ?>" alt="">
              <p><?= $equipement->label ?> </p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
</div>
    </div>

  </div>
</div>


















<form class="formulaire" action="/reservation_form" method="post" onsubmit="copierSpanDansHidden()">
  <input type="hidden" name="user_id" value="<?= Session::get(Session::USER)->id ?>">
  <h2>Réservations</h2>

  <div class="form-group">
    <label for="start_date">Date d'arrivée</label>
    <input id="start_date" type="date" class="form-control" name="date_start" required>
  </div>
  <div class="form-group">
    <label for="end_date">Date de départ</label>
    <input id="end_date" type="date" class="form-control" name="date_end" required>
  </div>
  <div class="form-group">
    <label for="nb_adult">Nombre d'adultes :</label>
    <input type="number" class="form-control" id="nb_adult" name="nb_adult" value="1" required>
  </div>
  <div class="form-group">
    <label for="nb_child">Nombre d'enfants :</label>
    <input type="number" class="form-control" id="nb_child" name="nb_child" value="0" required>
  </div>

  <h4>Total : <span id="total" name="price_total"> </span> €</h4>
  <input type="hidden" id="hidden_input" name="price_total" value="<?= $logement->price_per_night ?>">
  <button type="submit" class="btn btn-primary">Réserver</button>
</form>