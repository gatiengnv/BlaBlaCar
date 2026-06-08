<?php
$role = (string)($_SESSION['login_role'] ?? '');
$loginId = (int)($_SESSION['login_id'] ?? -1);
?>

<nav class="navbar navbar-expand-lg bg-success fixed-top">
    <div class="container-fluid">

        <a class="navbar-brand" href="router.php?action=menuAccueil">
            Nicart & Genevois
        </a>

        <?php if ($loginId !== -1): ?>
            <span class="navbar-text me-3">
                    Bonjour <?= htmlspecialchars($_SESSION['login_name'] ?? '') ?>
            </span>
            <span class="navbar-text me-3">
                <?= htmlspecialchars($_SESSION['solde'] ?? '') ?> €
            </span>
        <?php endif; ?>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if ($loginId !== -1 && $role === 'administrateur'): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">
                            Administrateur
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="router.php?action=utilisateursReadAll">Liste des
                                    utilisateurs</a></li>
                            <li><a class="dropdown-item" href="router.php?action=conducteurCreate">Ajout d'un
                                    conducteur</a></li>
                            <li><a class="dropdown-item" href="router.php?action=passagerCreate">Ajout d'un passager</a>
                            </li>
                            <li><a class="dropdown-item" href="router.php?action=vehiculesReadAll">Liste des
                                    véhicules</a></li>
                            <li><a class="dropdown-item" href="router.php?action=vehicleCreate">Ajout d'un véhicule</a>
                            </li>

                            <li><a class="dropdown-item" href="router.php?action=villesReadAll">Liste des villes</a>
                            </li>
                            <li><a class="dropdown-item" href="router.php?action=villeCreate">Ajout d'une ville</a></li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if ($loginId !== -1 && $role === 'conducteur'): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">
                            Conducteur
                        </a>
                        <ul class="dropdown-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="router.php?action=mesVehicules">Liste de mes véhicules</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="router.php?action=mesTrajets">Liste de tout mes trajets
                                    (actifs et passifs)</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="router.php?action=trajetCreate">Ajout d'un trajet</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="router.php?action=trajetPassagers">Liste des passagers de l'un
                                    de mes trajets actifs</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="router.php?action=mesTrajets">Cloturer l'un de mes trajets
                                    actifs</a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <?php if ($loginId !== -1 && $role === 'passager'): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">
                            Passager
                        </a>
                        <ul class="dropdown-menu">
                            <li class="nav-item">
                                <a class="nav-link" href="router.php?action=passagerReservations">
                                    Liste de mes réservations
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="router.php?action=trajetReservation">
                                    Réservation d'un trajet actif
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">
                        Innovations
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="router.php?action=">Proposez une fonctionnalité originale</a>
                        </li>
                    </ul>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="router.php?action=">Proposez une amélioration du code MVC</a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown">
                        Examinateur
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="router.php?action=examinateurSuperglobales">
                                SuperGlobales (Cookies et Session)</a></li>
                        <li><a class="dropdown-item" href="router.php?action=examinateurReservationsAleatoires">
                                Ajout de 10 Réservations aléatoires</a></li>
                    </ul>
                </li>

            </ul>

            <ul class="navbar-nav">

                <?php if ($loginId === -1): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="router.php?action=loginForm">
                            Se connecter
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="router.php?action=logout">
                            Se déconnecter
                        </a>
                    </li>
                <?php endif; ?>

            </ul>

        </div>
    </div>
</nav>