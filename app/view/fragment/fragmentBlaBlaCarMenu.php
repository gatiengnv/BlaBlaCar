<nav class="navbar navbar-expand-lg bg-success fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="router.php?action=action">BlaBlaCar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <?php
                // afficher les menus selon le rôle stocké en session
                /** @var string $role */
                $role = (string) ($_SESSION['login_role'] ?? '');
                if ($role === 'administrateur') {
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                           aria-expanded="false">Administrateur</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="router.php?action=utilisateursReadAll">Liste des
                                utilisateurs</a></li>
                            <li><a class="dropdown-item" href="router.php?action=villesReadAll">Liste des villes</a></li>
                            <li><a class="dropdown-item" href="router.php?action=vehiculesReadAll">Liste des véhicules</a>
                            </li>
                            <li><a class="dropdown-item" href="router.php?action=villeCreate">Ajout d'une ville</a></li>
                            <li><a class="dropdown-item" href="router.php?action=vehicleCreate">Ajout d'un véhicule</a></li>
                        </ul>
                    </li>
                    <?php
                }
                if ($role === 'conducteur') {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="router.php?action=mesVehicules">Mes véhicules</a>
                    </li>
                    <?php
                }
                ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">Innovations</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="router.php?action=">...</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"
                       aria-expanded="false">Examinateur</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="router.php?action=">...</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <?php /** @var int $loginId */ $loginId = (int) ($_SESSION['login_id'] ?? -1); ?>
                    <?php if ($loginId === -1): ?>
                        <a class="nav-link" href="router.php?action=loginForm">Se connecter</a>
                    <?php else: ?>
                        <a class="nav-link" href="#">Bonjour <?php echo htmlspecialchars($_SESSION['login_name'] ?? ''); ?></a>
                    <?php endif; ?>
                </li>
                <?php if ($loginId !== -1): ?>
                    <li class="nav-item"><a class="nav-link" href="router.php?action=logout">Se déconnecter</a></li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</nav>