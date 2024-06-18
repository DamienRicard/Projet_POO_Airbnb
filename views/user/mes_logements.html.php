<h4 class="text-center m-5">Mes logements disponibles à la location</h4>

<div class="card-logements">
  <!--$meslogements vient du Controller UserController (car c'est lui qui appelle la vue user/mes_logements) et de la fonction LogementsByUserId -->
  <!--pour $meslogement on met le nom que l'on veut -->
  <?php foreach ($meslogements as $logements) : ?>
    <div >
      <div class="each-logement">
        <p> <?= $logements->title ?></p> <!-- title = nom colonne de la BDD -->
        <p> <?= $logements->description ?></p>
        <p> Prix de la nuit : <?= $logements->price_per_night ?> €</p>
        <p> Nombre de chambres : <?= $logements->nb_room ?></p>
        <p> Nombre de lits : <?= $logements->nb_bed ?></p>
        <p> Nombre de salles de bain : <?= $logements->nb_bath ?></p>
        <p> Nombre de voyageurs maximum : <?= $logements->nb_traveler ?></p>

      </div>
    </div>
  <?php endforeach; ?>

</div>