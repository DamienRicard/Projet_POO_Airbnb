<div class="d-flex  flex-column align-items-center m-5">
  <h3 class="mb-5">Réservations de mes logements</h3>
  <div class="d-flex gap-5">

    <?php if (empty($reservations)) : ?>
      <div class="alert alert-info" role="alert">
        Vous n'avez aucune reservation pour ce logement
      </div>
    <?php else : ?>
      <?php foreach ($reservations as $reservation) : ?>
        <?php foreach ($media as $media) : ?>
          <img style="width: 500px; height: 500px" src="/assets/images/<?= $media->image_path ?>" alt="">
        <?php endforeach; ?>

        <div class="card-reservation">
          <p class="">Logement réservé </p>
          <p class="card-text">du : <?= $reservation->date_start ?> </p>
          <p class="card-text">au : <?= $reservation->date_end ?></p>
          <p class="card-text">Nombre d'adultes : <?= $reservation->nb_adult ?></p>
          <p class="card-text">Nombre d'enfants : <?= $reservation->nb_child ?></p>
          <p class="card-text">Prix total : <?= $reservation->price_total ?> €</p>
        </div>

      <?php endforeach; ?>
    <?php endif ?>
  </div>
</div>