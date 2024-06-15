<?php if (!$auth::isAuth()) $auth::redirect('/connexion') ?>

<?php

use Core\Session\Session; ?>

<div class="card" style="width: 18rem;">
  <div class="card-body width-150">

    <?php foreach ($logement->medias as $media) : ?>
      <img src="/assets/images/<?= $media->image_path ?>" class="card-img-top" alt="">
    <?php endforeach; ?>
    <h1> <?= $logement->title ?> </h1>
    <p><?= $logement->description ?></p>
    <p>Type de logement : <?= $logement->type_logement->label ?></p>
    <p><span id="nightPrice"><?= $logement->price_per_night ?> </span>€ / nuit </p>
    <p>Taille du logement : <?= $logement->Taille ?> m² </p>
    <p>Nombre de chambres : <?= $logement->nb_room ?> </p>
    <p>Nombre de lits : <?= $logement->nb_bed ?> </p>
    <p>Nombre de salle de bains : <?= $logement->nb_bath ?> </p>
    <p>Nombre de voyageurs : <?= $logement->nb_traveler ?> </p>
  </div>
</div>


<form action="/reservation_form" method="post" onsubmit="copierSpanDansHidden()">
  <input type="hidden" name="user_id" value="<?= Session::get(Session::USER)->id ?>">
  <h2>Réservations</h2>

  <label for="start_date">Start</label>
  <input id="start_date" type="date" name="date_start" required />
  <label for="end_date">End</label>
  <input id="end_date" type="date" name="date_end" required />

  <h3>Total : <span id="total" name="price_total"> </span> €</h3>
  <input type="hidden" id="hidden_input" name="price_total"></input>
  <button class="btn btn-success">Réserver</button>
</form>