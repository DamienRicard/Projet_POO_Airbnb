    <div class="d-flex justify-content-around">
      <!-- logo -->
      <div class="nav-logo">
        <a href="/">
          <img class="m-4" src="../assets/images/logo_airbnb.png" alt="logo application Airbnb">
        </a>
      </div>

      <!--  barre de navigation -->
      <div>
        <nav>
          <ul class="d-flex justify-content-center">
            <li class="m-4"><a href="/">Accueil</a></li>
            <li class="m-4"><a href="#">Logements</a></li>
            <li class="m-4"><a href="#">Mettre mon logement sur Airbnb</a></li>
          </ul>
        </nav>
      </div>
      <!-- menu du profil -->
      <div>
        <nav>
          <ul>
            <li>
              <!-- si je suis en session j'affiche mon compte -->
              <?php if ($auth::isAuth()) : ?>
                <div class="dropdown custom-link">
                  <a class="dropdown-toggle" href="" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    Mon compte <i class="bi bi-person custom-svg"> </i>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item custom-link" href="#">Mon profil</a></li>
                    <li><a class="dropdown-item custom-link" href="# ">Mes réservations</a></li>
                    <li><a class="dropdown-item custom-link" href="#">Mes logements en location</a></li>
                    <li>
                      <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item custom-link" href="/logout">Déconnexion</a></li>
                  </ul>
                </div>
              <?php else : ?>
                <a href="/connexion">Se connecter
                  <i class="bi bi-person custom-svg"></i>
                </a>
              <?php endif ?>
            </li>
          </ul>

        </nav>
      </div>


    </div>