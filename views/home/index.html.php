<h1 class="text-center">Les locations disponibles</h1>

<!-- Pour chaque tableau $logements (donc chaque ligne de la bdd) ont crée un tableau $logement. En gros pour chaque ligne ça va créer une div card  -->
<?php foreach ($logements as $logement) : ?>


<div class="card" style="width: 18rem;">
<div class="card-body width-150">
  <?php foreach ($logement->medias as $media): ?>
<img src="/assets/images/<?= $media?>" class="card-img-top" alt="">
  <?php endforeach; ?>
<h5 class="card-title"> <?= $logement->title?> <span class="text-primary" style="width: 5rem;">&hearts;</span></h5>
<p class="card-text"> With supporting text below as a natural lead-in to additional content.</p>
<a href="/logement_detail/<?= $logement->id?> " class="btn btn-primary">Voir les détails</a>
<p> <?= $logement->price_per_night?> €</p>
</div>
</div>


<?php endforeach; ?>
