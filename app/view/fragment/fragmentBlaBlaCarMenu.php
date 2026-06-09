<?php
$role = (string) ($_SESSION['login_role'] ?? '');
$loginId = (int) ($_SESSION['login_id'] ?? -1);
$loginName = htmlspecialchars($_SESSION['login_name'] ?? '');
$userSolde = $_SESSION['login_solde'] ?? null;
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-success shadow-sm">
    <div class="container-fluid px-4">

        <a class="navbar-brand fw-bold d-flex align-items-center gap-2"
            href="router.php?action=menuAccueil">
            <i class="bi bi-car-front-fill"></i>
            <span>BlaBlaCar</span>
        </a>

        <button class="navbar-toggler border-0" type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-3">

                <?php if ($loginId !== -1 && $role === 'administrateur'): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-shield-lock-fill me-1"></i>
                            Administration
                        </a>

                        <ul class="dropdown-menu shadow-sm border-0 rounded-3">

                            <li>
                                <h6 class="dropdown-header">Consultation</h6>
                            </li>

                            <li>
                                <a class="dropdown-item" href="router.php?action=utilisateursReadAll">
                                    <i class="bi bi-people-fill me-2"></i>Utilisateurs
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="router.php?action=villesReadAll">
                                    <i class="bi bi-buildings-fill me-2"></i>Villes
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="router.php?action=vehiculesReadAll">
                                    <i class="bi bi-car-front-fill me-2"></i>Véhicules
                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <h6 class="dropdown-header">Ajout</h6>
                            </li>

                            <li>
                                <a class="dropdown-item" href="router.php?action=villeCreate">
                                    <i class="bi bi-plus-circle-fill me-2"></i>Ajouter une ville
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="router.php?action=vehicleCreate">
                                    <i class="bi bi-plus-circle-fill me-2"></i>Ajouter un véhicule
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="router.php?action=conducteurCreate">
                                    <i class="bi bi-person-plus-fill me-2"></i>Ajouter un conducteur
                                </a>
                            </li>

                            <li>
                                <a class="dropdown-item" href="router.php?action=passagerCreate">
                                    <i class="bi bi-person-plus-fill me-2"></i>Ajouter un passager
                                </a>
                            </li>

                        </ul>
                    </li>
                <?php endif; ?>

                <?php if ($loginId !== -1 && $role === 'conducteur'): ?>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="router.php?action=mesVehicules">
                            <i class="bi bi-car-front-fill me-1"></i>
                            Mes véhicules
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="router.php?action=mesTrajets">
                            <i class="bi bi-sign-turn-right-fill me-1"></i>
                            Mes trajets
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="router.php?action=trajetCreate">
                            <i class="bi bi-plus-circle-fill me-1"></i>
                            Créer un trajet
                        </a>
                    </li>
                <?php endif; ?>

                <?php if ($loginId !== -1 && $role === 'passager'): ?>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="router.php?action=passagerReservations">
                            <i class="bi bi-ticket-perforated-fill me-1"></i>
                            Mes réservations
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="router.php?action=trajetReservation">
                            <i class="bi bi-search me-1"></i>
                            Réserver un trajet
                        </a>
                    </li>
                <?php endif; ?>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-lightbulb-fill me-1"></i>
                        Innovations
                    </a>

                    <ul class="dropdown-menu shadow-sm border-0 rounded-3">
                        <li>
                            <a class="dropdown-item" href="router.php?action=compagnonsDeRoute">
                                <i class="bi bi-people-fill me-2"></i>Compagnons de Route
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="router.php?action=innovationRouter">
                                <i class="bi bi-shield-check me-2"></i>Sécurité du Routeur
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="bi bi-clipboard-data-fill me-1"></i>
                        Examinateur
                    </a>

                    <ul class="dropdown-menu shadow-sm border-0 rounded-3">

                        <li>
                            <a class="dropdown-item" href="router.php?action=examinateurSuperglobales">
                                <i class="bi bi-database-fill me-2"></i>
                                E1 - SuperGlobales
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="router.php?action=examinateurReservationsAleatoires">
                                <i class="bi bi-shuffle me-2"></i>
                                E2 - Réservations aléatoires
                            </a>
                        </li>

                    </ul>
                </li>

            </ul>

            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">

                <?php if ($loginId !== -1): ?>
                    <li class="nav-item me-3">
                        <div class="d-flex flex-column align-items-end">

                            <span class="navbar-text text-white">
                                Bonjour <?= $loginName ?>
                            </span>

                            <?php if ($userSolde !== null): ?>
                                <span class="badge bg-light text-success">
                                    <i class="bi bi-wallet2 me-1"></i>
                                    <?= number_format((float)$userSolde, 2, ',', ' ') ?> €
                                </span>
                            <?php endif; ?>

                        </div>
                    </li>
                <?php endif; ?>

                <li class="nav-item">
                    <?php if ($loginId === -1): ?>
                        <a class="btn btn-light btn-sm rounded-pill px-3 fw-semibold"
                            href="router.php?action=loginForm">
                            <i class="bi bi-box-arrow-in-right me-1"></i>
                            Se connecter
                        </a>
                    <?php else: ?>
                        <a class="btn btn-outline-light btn-sm rounded-pill px-3 fw-semibold"
                            href="router.php?action=logout">
                            <i class="bi bi-box-arrow-right me-1"></i>
                            Se déconnecter
                        </a>
                    <?php endif; ?>
                </li>

            </ul>

        </div>
    </div>
</nav>