<?php
$rootPath = isset($root) ? $root : '';
$results = $results ?? [];
require($rootPath . '/app/view/fragment/fragmentBlaBlaCarHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $rootPath . '/app/view/fragment/fragmentBlaBlaCarMenu.html';
        include $rootPath . '/app/view/fragment/fragmentBlaBlaCarJumbotron.html';
        ?>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Marque</th>
                    <th scope="col">Modele</th>
                    <th scope="col">Annee</th>
                    <th scope="col">Immatriculation</th>
                    <th scope="col">Proprietaire ID</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($results as $element) {
                    printf(
                        "<tr><td>%d</td><td>%s</td><td>%s</td><td>%d</td><td>%s</td><td>%d</td></tr>",
                        $element->getId(),
                        $element->getMarque(),
                        $element->getModele(),
                        $element->getAnnee(),
                        $element->getImmatriculation(),
                        $element->getProprietaire_id()


                    );
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php include $rootPath . '/app/view/fragment/fragmentBlaBlaCarFooter.html'; ?>