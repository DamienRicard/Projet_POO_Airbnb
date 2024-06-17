<?php

use App\AppRepoManager;
use Core\Session\Session; ?>

<h2> Ajouter un logement à la location</h2>





<form action="/add_logement_form" method="post">
    <!-- envoie l'utilisateur en session -->
    <input type="hidden" name="user_id" value="<?= Session::get(Session::USER)->id ?>">
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Titre du logement</label>
        <input type="text" class="form-control" id="exampleInputPassword1" name="title">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Pays</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="country">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Ville</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="city">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Phone</label>
        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="phone">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Code postal</label>
        <input type="int" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="zip_code">
    </div>
    <div class="mb-3">
        <label for="type" class="form-label">Type de logement</label>
        <!--TODO: requete pour récup les types plus foreach -->
        <?php foreach (AppRepoManager::getRm()->getTypeLogementRepository()->getAllTypes() as $type) : ?>
            <div>
                <label><input type="checkbox" name="type_logement_id" value="<?= $type->id ?>"> <?= $type->label ?> </label>
            </div>
        <?php endforeach; ?>







    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Taille du logement</label>
        <input type="number" class="form-control" id="exampleInputPassword1" name="size">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Description</label>
        <input type="text" class="form-control" id="exampleInputPassword1" name="description">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Nombre de chambres</label>
        <input type="number" class="form-control" id="exampleInputPassword1" name="nb_room">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Nombre de lits</label>
        <input type="number" class="form-control" id="exampleInputPassword1" name="nb_bed">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Nombre de salle de bain</label>
        <input type="number" class="form-control" id="exampleInputPassword1" name="nb_bath">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Nombre de voyageurs</label>
        <input type="number" class="form-control" id="exampleInputPassword1" name="nb_traveler">
    </div>
    <div class="mb-3">

        <h3 class="sub-title">Equipements :</h3>
        <div class="box-auth-input list-ingredient">
            <!-- on va boucler sur notre tableau d'équipements -->
            <?php foreach (AppRepoManager::getRm()->getEquipementRepository()->getEquipementActiveBylabel() as $label => $equipements) : ?>
                <div class="list-ingredient-box-update">
                    <h5 class="title-update"> <?= ucfirst($label) ?> </h5>
                    <?php foreach ($equipements as $equipement) : ?>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="equipements[]" value="<?= $equipement->id ?>" role="switch">
                            <label class="form-check-label footer-description m-1">
                                <img src="/assets/icons/icons/<?= $equipement->image_path ?>" alt="<?= $equipement->label ?>" style="width: 24px; height: 24px; margin-right: 8px;">
                                <?= $equipement->label ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>

            <?php endforeach; ?>
        </div>

    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Prix par nuit</label>
        <input type="number" class="form-control" id="exampleInputPassword1" name="price_per_night">
    </div>

    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>