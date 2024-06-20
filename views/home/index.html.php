<div class="container">
    <div class="accueil">
      <p class="paragraphe">
        <span class="titre-principal">
          Bienvenue sur le site de <strong>Airbnb</strong>
        </span>
      </p>
      <p class="paragraphe">
        <span class="titre-principal">
          Location de vacances, Cabanes, <br>Maisons de campagnes et bien d'autres
        </span>
      </p>
    </div>

    <h3 class="available text-start mb-4">Tous les logements disponibles :</h3>
    <div class="row justify-content-center">
      <?php foreach ($logements as $logement) : ?>
        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
          <div class="card h-100">
            <a href="/logement_detail/<?= $logement->id ?>">
              <?php foreach ($logement->media as $medias) : ?>
                <img src="/assets/images/<?= $medias ?>" class="card-img-top" alt="">
              <?php endforeach; ?>
            </a>
            <div class="card-body">
              <h5 class="card-title"> <?= $logement->title ?> </h5>
              <p class="card-text"> <?= $logement->price_per_night ?> € / nuit</p>
              <a href="/logement_detail/<?= $logement->id ?>" class="btn btn-primary">Voir les détails</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
</div>