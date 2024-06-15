<?php use Core\Session\Session; ?>

<h2> Ajouter un logement à la location</h2>

<?php include(PATH_ROOT . 'views/_templates/_message.html.php') ?>



<form action="/add_logement_form" method="post">
    <!-- envoie l'utilisateur en session -->
    <input type="hidden" name="user_id" value="<?= Session::get(Session::USER)->id ?>">
<div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Titre du logement</label>
        <input type="text" class="form-control" id="exampleInputPassword1" name="title">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Pays</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="pays">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Ville</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="ville">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Code postal</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="zip_code">
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
        <label for="exampleInputPassword1" class="form-label">Nombres de chambres</label>
        <input type="number" class="form-control" id="exampleInputPassword1" name="nb_room">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Nombres de lits</label>
        <input type="number" class="form-control" id="exampleInputPassword1" name="nb_bed">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Nombre de voyageurs</label>
        <input type="number" class="form-control" id="exampleInputPassword1" name="nb_traveler">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Prix par nuit</label>
        <input type="number" class="form-control" id="exampleInputPassword1" name="price">
    </div>

    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>