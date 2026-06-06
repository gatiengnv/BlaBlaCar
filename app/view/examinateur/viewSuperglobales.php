<?php
$rootPath = isset($root) ? (string) $root : '';
require($rootPath . '/app/view/fragment/fragmentBlaBlaCarHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $rootPath . '/app/view/fragment/fragmentBlaBlaCarMenu.php';
        include $rootPath . '/app/view/fragment/fragmentBlaBlaCarJumbotron.html';
        ?>

        <h2 class="mb-4">E1 - SuperGlobales : Cookies et Sessions</h2>

        <!-- Contenu de $_SESSION -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">$_SESSION</h4>
            </div>
            <div class="card-body">
                <?php if (empty($_SESSION)): ?>
                    <div class="alert alert-warning mb-0">Aucune donnée en session.</div>
                <?php else: ?>
                    <table class="table table-striped table-bordered">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col">Clé</th>
                                <th scope="col">Valeur</th>
                                <th scope="col">Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($_SESSION as $cle => $valeur): ?>
                                <tr>
                                    <td><code><?php echo htmlspecialchars((string) $cle); ?></code></td>
                                    <td>
                                        <?php
                                        if (is_array($valeur)) {
                                            echo '<pre>' . htmlspecialchars(print_r($valeur, true)) . '</pre>';
                                        } else {
                                            echo htmlspecialchars((string) $valeur);
                                        }
                                        ?>
                                    </td>
                                    <td><span class="badge bg-secondary"><?php echo gettype($valeur); ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>

        <!-- Contenu de $_COOKIE -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">$_COOKIE</h4>
            </div>
            <div class="card-body">
                <?php if (empty($_COOKIE)): ?>
                    <div class="alert alert-warning mb-0">Aucun cookie détecté.</div>
                <?php else: ?>
                    <table class="table table-striped table-bordered">
                        <thead class="table-success">
                            <tr>
                                <th scope="col">Clé</th>
                                <th scope="col">Valeur</th>
                                <th scope="col">Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($_COOKIE as $cle => $valeur): ?>
                                <tr>
                                    <td><code><?php echo htmlspecialchars((string) $cle); ?></code></td>
                                    <td>
                                        <?php
                                        if (is_array($valeur)) {
                                            echo '<pre>' . htmlspecialchars(print_r($valeur, true)) . '</pre>';
                                        } else {
                                            echo htmlspecialchars((string) $valeur);
                                        }
                                        ?>
                                    </td>
                                    <td><span class="badge bg-secondary"><?php echo gettype($valeur); ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>

        <!-- Vérification des informations de connexion -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0">Vérification des informations de connexion</h4>
            </div>
            <div class="card-body">
                <?php
                $loginId = $_SESSION['login_id'] ?? -1;
                $loginRole = $_SESSION['login_role'] ?? 'non défini';
                $loginName = $_SESSION['login_name'] ?? 'non défini';
                ?>
                <?php if ((int) $loginId === -1): ?>
                    <div class="alert alert-danger">
                        <strong>Non connecté.</strong> Aucun utilisateur n'est actuellement connecté (login_id = -1).
                    </div>
                <?php else: ?>
                    <div class="alert alert-success">
                        <strong>Connecté.</strong> Un utilisateur est actuellement authentifié.
                    </div>
                    <table class="table table-bordered">
                        <tr>
                            <th>login_id</th>
                            <td><?php echo htmlspecialchars((string) $loginId); ?></td>
                            <td><?php echo ((int) $loginId > 0) ? '<span class="badge bg-success">OK</span>' : '<span class="badge bg-danger">Invalide</span>'; ?></td>
                        </tr>
                        <tr>
                            <th>login_role</th>
                            <td><?php echo htmlspecialchars((string) $loginRole); ?></td>
                            <td><?php echo in_array($loginRole, ['administrateur', 'conducteur', 'passager']) ? '<span class="badge bg-success">OK</span>' : '<span class="badge bg-danger">Invalide</span>'; ?></td>
                        </tr>
                        <tr>
                            <th>login_name</th>
                            <td><?php echo htmlspecialchars((string) $loginName); ?></td>
                            <td><?php echo (!empty($loginName) && $loginName !== 'non défini') ? '<span class="badge bg-success">OK</span>' : '<span class="badge bg-danger">Invalide</span>'; ?></td>
                        </tr>
                    </table>
                <?php endif; ?>
            </div>
        </div>

    </div>

    <?php include $rootPath . '/app/view/fragment/fragmentBlaBlaCarFooter.html'; ?>
</body>
