<?php if (!$auth::isAuth()) $auth::redirect('/connexion') ?>


<h3 class="title-reservation">Mes réservations</h3>


<?php foreach ($reservations as $reservation) : ?>

  <div class="card-reservation">
    <p> Date de réservation : du <?= $reservation->date_start ?></p>
    <p> au : <?= $reservation->date_end ?></p>
    <p> Prix total du séjour : <?= $reservation->price_total ?> € </p>
    <p> Nombre d'adultes : <?= $reservation->nb_adult ?></p>
  <hr>
</div>
<?php endforeach; ?>
