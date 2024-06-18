<?php if (!$auth::isAuth()) $auth::redirect('/connexion') ?>


<h3 class="title-reservation">Mes réservations</h3>

<!--$reservations vient du Controller UserController (car c'est lui qui appelle la vue home/mes_reservations) et de la fonction myReservationsByUserId -->
<?php foreach ($reservations as $reservation) : ?>

  <div class="card-reservation">
    <p> Date de réservation : du <?= $reservation->date_start ?></p>  <!-- date_start = nom colonne de la BDD -->
    <p> au : <?= $reservation->date_end ?></p>
    <p> Prix total du séjour : <?= $reservation->price_total ?> € </p>
    <p> Nombre d'adultes : <?= $reservation->nb_adult ?></p>
  <hr>
</div>
<?php endforeach; ?>
