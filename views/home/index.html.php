
<div class="accueil text-center">
  <p class="paragraphe">
    <span class="titre-principal"> <!--dans un span pour avoir l'animation uniquement sur la largeur du texte-->
      Bienvenue sur le site de <strong>Airbnb</strong>
    </span>
  </p>
  <p class="paragraphe">
    <span class="titre-principal">
      Location de vacances, Cabanes, <br>Maisons de campagnes et bien d'autres
    </span>
  </p>

</div>

<h3 class="available">Tous les logements disponibles :</h3>
<div class="container">

  <!-- Pour chaque tableau $logements (donc chaque ligne de la bdd) ont crée un tableau $logement. En gros pour chaque ligne ça va créer une div card  -->
  <?php foreach ($logements as $logement) : ?>

    <div class="card">
      <div class="card-body">
      <a href="/logement_detail/<?= $logement->id ?>">
        <?php foreach ($logement->medias as $media) : ?>
          <img src="/assets/images/<?= $media ?>" class="card-img-top" alt="">
        <?php endforeach; ?>
      </a>
        <h5 class="card-title"> <?= $logement->title ?> </h5><i class="bi bi-star-fill"></i><span id="randomNumber"></span>
        <p> <?= $logement->price_per_night ?> € / nuit</p>
        <a href="/logement_detail/<?= $logement->id ?> " class="btn">Voir les détails</a>
       
      </div>
    </div>

  <?php endforeach; ?>
</div>