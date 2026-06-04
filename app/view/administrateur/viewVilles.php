<?php
$rootPath = isset($root) ? $root : '';
$results = $results ?? [];
require($rootPath . '/app/view/fragment/fragmentBlaBlaCarHeader.html');
?>

<body>
    <div class="container">
        <?php
        include $rootPath . '/app/view/fragment/fragmentBlaBlaCarMenu.php';
        include $rootPath . '/app/view/fragment/fragmentBlaBlaCarJumbotron.html';
        ?>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Ville</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($results as $element) {
                    printf(
                        "<tr><td>%d</td><td>%s</td></tr>",
                        $element->getId(),
                        $element->getNom(),
                    );
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php include $rootPath . '/app/view/fragment/fragmentBlaBlaCarFooter.html'; ?>