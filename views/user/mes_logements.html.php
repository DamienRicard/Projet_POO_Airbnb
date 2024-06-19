<h4 class="text-center m-5">Mes logements disponibles à la location</h4>

<div class="container">
  <div class="row">
    <?php foreach ($meslogements as $logements) : ?>
      <div class="col-md-4">
        <div class="card mb-4">
          <?php if ($logements->image_path) : ?>
            <img src="/assets/images/<?= $logements->image_path ?>" class="card-img-top logement-image" alt="<?= $logements->title ?>">
          <?php else : ?>
            <img src="/assets/images/default.jpg" class="card-img-top logement-image" alt="Image par défaut">
          <?php endif; ?>
          <div class="card-body">
            <h5 class="card-title"><?= $logements->title ?></h5>
            <p class="card-text"><?= $logements->description ?></p>
            <p class="card-text">Prix de la nuit : <?= $logements->price_per_night ?> €</p>
            <p class="card-text">Nombre de chambres : <?= $logements->nb_room ?></p>
            <p class="card-text">Nombre de lits : <?= $logements->nb_bed ?></p>
            <p class="card-text">Nombre de salles de bain : <?= $logements->nb_bath ?></p>
            <p class="card-text">Nombre de voyageurs maximum : <?= $logements->nb_traveler ?></p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
