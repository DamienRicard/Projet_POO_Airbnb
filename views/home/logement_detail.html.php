<?php use Core\Session\Session; ?>
<div class="container mt-5">
    <?php if (!$auth::isAuth()) $auth::redirect('/connexion') ?>

    <div class="card card-detail">
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <?php foreach ($logement->medias as $index => $media) : ?>
            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
              <img src="/assets/images/<?= $media->image_path ?>" class="d-block w-100" alt="Image du logement">
            </div>
          <?php endforeach; ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

      <div class="card-body card-body-detail">
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
    </div>

    <form class="formulaire" action="/reservation_form" method="post" onsubmit="copierSpanDansHidden()">
      <input type="hidden" name="user_id" value="<?= Session::get(Session::USER)->id ?>">
      <h2>Réservations</h2>

      <div class="form-group">
        <label for="start_date">Date d'arrivée</label>
        <input id="start_date" type="date" class="form-control" name="date_start" required />
      </div>
      <div class="form-group">
        <label for="end_date">Date de départ</label>
        <input id="end_date" type="date" class="form-control" name="date_end" required />
      </div>

      <h3>Total : <span id="total" name="price_total"> </span> €</h3>
      <input type="hidden" id="hidden_input" name="price_total">
      <button type="submit" class="btn btn-primary">Réserver</button>
    </form>
  </div>