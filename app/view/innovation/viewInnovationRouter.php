<?php
$rootPath = isset($root) ? (string) $root : '';
$allowedActions = $allowedActions ?? array();
require($rootPath . '/app/view/fragment/fragmentBlaBlaCarHeader.html');
?>

<body>
    <?php include $rootPath . '/app/view/fragment/fragmentBlaBlaCarMenu.php'; ?>

    <div class="container py-4">

        <div class="text-center mb-4">
            <h2><i class="bi bi-shield-check text-success me-2"></i>Sécurité du Routeur : Liste Blanche</h2>
            <p class="text-muted">
                Comprendre le mécanisme de sécurité du tableau associatif <code>$allowed_actions</code> dans le routeur.
            </p>
        </div>

        <!-- Explication du concept -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-success text-white">
                <i class="bi bi-book me-2"></i>Principe de fonctionnement
            </div>
            <div class="card-body">
                <h5>Qu'est-ce que <code>$allowed_actions</code> ?</h5>
                <p>
                    Le fichier <code>router.php</code> utilise un <strong>tableau associatif PHP</strong> appelé 
                    <code>$allowed_actions</code> qui agit comme une <strong>liste blanche</strong> (whitelist). 
                    Ce tableau définit explicitement toutes les actions autorisées dans l'application.
                </p>

                <div class="alert alert-secondary">
                    <h6><i class="bi bi-code-slash me-2"></i>Structure du tableau :</h6>
<pre class="mb-0"><code>$allowed_actions = array(
    "nomAction" => array(
        "controller" => "NomDuController",
        "method"     => "nomDeLaMethode"
    ),
    ...
);</code></pre>
                </div>

                <h5 class="mt-4">Comment ça marche ?</h5>
                <ol>
                    <li>L'utilisateur envoie une requête avec un paramètre <code>?action=nomAction</code> dans l'URL.</li>
                    <li>Le routeur vérifie si cette action <strong>existe comme clé</strong> dans <code>$allowed_actions</code>.</li>
                    <li>Si l'action est trouvée, le routeur appelle la méthode correspondante du contrôleur associé.</li>
                    <li>Si l'action <strong>n'existe pas</strong> dans le tableau, le routeur redirige vers l'action par défaut (<code>menuAccueil</code>).</li>
                </ol>

                <div class="alert alert-warning mt-3">
                    <h6><i class="bi bi-exclamation-triangle-fill me-2"></i>Mécanisme de sécurité :</h6>
<pre class="mb-0"><code>if (!array_key_exists($action, $allowed_actions)) {
    $action = "menuAccueil"; // Action par défaut
}</code></pre>
                    <p class="mt-2 mb-0">
                        Ce test empêche l'exécution de code arbitraire. Même si un utilisateur malveillant 
                        modifie l'URL avec une action inventée (ex: <code>?action=supprimerTout</code>), 
                        celle-ci sera ignorée car elle n'est pas dans la liste blanche.
                    </p>
                </div>

                <h5 class="mt-4">Avantages de cette approche</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card border-success mb-3">
                            <div class="card-body">
                                <h6 class="card-title text-success"><i class="bi bi-shield-fill-check me-2"></i>Sécurité</h6>
                                <p class="card-text small">Seules les actions explicitement déclarées sont exécutables. Aucune injection de code via l'URL n'est possible.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-success mb-3">
                            <div class="card-body">
                                <h6 class="card-title text-success"><i class="bi bi-diagram-3-fill me-2"></i>Centralisation</h6>
                                <p class="card-text small">Toutes les routes sont définies à un seul endroit, facilitant la maintenance et la lisibilité du code.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-success mb-3">
                            <div class="card-body">
                                <h6 class="card-title text-success"><i class="bi bi-arrows-angle-expand me-2"></i>Extensibilité</h6>
                                <p class="card-text small">Ajouter une nouvelle fonctionnalité revient à ajouter une entrée dans le tableau et créer le contrôleur/vue associé.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-success mb-3">
                            <div class="card-body">
                                <h6 class="card-title text-success"><i class="bi bi-link-45deg me-2"></i>Découplage MVC</h6>
                                <p class="card-text small">Le routeur fait le lien entre l'URL (la vue demandée) et le contrôleur, respectant le pattern MVC.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau des actions autorisées -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-success text-white">
                <i class="bi bi-table me-2"></i>Liste complète des actions autorisées
                <span class="badge bg-light text-success ms-2"><?php
                    $total = 0;
                    foreach ($allowedActions as $actions) { $total += count($actions); }
                    echo $total;
                ?> actions</span>
            </div>
            <div class="card-body p-0">
                <?php foreach ($allowedActions as $categorie => $actions): ?>
                    <h6 class="px-3 pt-3 pb-1 text-success border-bottom">
                        <i class="bi bi-folder-fill me-2"></i><?php echo htmlspecialchars($categorie); ?>
                    </h6>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-3">Action (clé)</th>
                                    <th>Controller</th>
                                    <th>Méthode</th>
                                    <th>URL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($actions as $entry): ?>
                                    <tr>
                                        <td class="ps-3">
                                            <code><?php echo htmlspecialchars($entry['action']); ?></code>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary bg-opacity-75"><?php echo htmlspecialchars($entry['controller']); ?></span>
                                        </td>
                                        <td>
                                            <code class="text-dark"><?php echo htmlspecialchars($entry['method']); ?>()</code>
                                        </td>
                                        <td>
                                            <a href="router.php?action=<?php echo htmlspecialchars($entry['action']); ?>" class="text-decoration-none small">
                                                <i class="bi bi-box-arrow-up-right me-1"></i>Tester
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Schéma du flux -->
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-header bg-success text-white">
                <i class="bi bi-diagram-2-fill me-2"></i>Flux de traitement d'une requête
            </div>
            <div class="card-body text-center">
                <div class="d-flex flex-wrap justify-content-center align-items-center gap-2">
                    <span class="badge bg-secondary fs-6 px-3 py-2">Requête HTTP</span>
                    <i class="bi bi-arrow-right text-muted fs-4"></i>
                    <span class="badge bg-info fs-6 px-3 py-2">?action=xxx</span>
                    <i class="bi bi-arrow-right text-muted fs-4"></i>
                    <span class="badge bg-warning text-dark fs-6 px-3 py-2">array_key_exists()</span>
                    <i class="bi bi-arrow-right text-muted fs-4"></i>
                    <span class="badge bg-success fs-6 px-3 py-2">Controller::method()</span>
                    <i class="bi bi-arrow-right text-muted fs-4"></i>
                    <span class="badge bg-primary fs-6 px-3 py-2">Vue PHP</span>
                </div>
                <p class="text-muted mt-3 small">
                    Si <code>array_key_exists()</code> retourne <code>false</code>, l'action par défaut <code>menuAccueil</code> est utilisée.
                </p>
            </div>
        </div>

    </div>

    <?php include $rootPath . '/app/view/fragment/fragmentBlaBlaCarFooter.html'; ?>
</body>
