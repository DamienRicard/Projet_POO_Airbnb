<h3>Réservations de mes logements</h3>
<div class="d-flex m-5">

<?php foreach ($reservations as $reservation) : ?>

  <div class="card-body">

    <p class="card-text">Logement réservé du : <?= $reservation->date_start ?> </p>
    <p class="card-text">au : <?= $reservation->date_end ?></p>
    <p class="card-text">Nombre d'adultes : <?= $reservation->nb_adult ?></p>
    <p class="card-text">Nombre d'enfants : <?= $reservation->nb_child ?></p>
    <p class="card-text">Prix total : <?= $reservation->price_total ?> €</p>

  </div>

<?php endforeach; ?>
</div>