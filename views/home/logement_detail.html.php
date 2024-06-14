<div class="card" style="width: 18rem;">
  <div class="card-body width-150">
    
    <?php foreach ($logement->medias as $media) : ?>
      <img src="/assets/images/<?= $media->image_path ?>" class="card-img-top" alt="">
    <?php endforeach; ?>
    <h1> <?= $logement->title ?> </h1>
    <p><?= $logement->description ?></p>
    <p>Type de logement : <?= $logement->type_logement->label ?></p>
    <p><?= $logement->price_per_night ?> € / nuit </p>
    <p>Nombre de chambres : <?= $logement->nb_room ?> </p>
    <p>Nombre de lits : <?= $logement->nb_bed ?> </p>
    <p>Nombre de salle de bains : <?= $logement->nb_bath ?> </p>
    <p>Nombre de voyageurs : <?= $logement->nb_traveler ?> </p>
  </div>
</div>