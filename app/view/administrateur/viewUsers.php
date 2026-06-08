<?php
$rootPath = isset($root) ? $root : '';
$results = $results ?? [];
require($rootPath . '/app/view/fragment/fragmentBlaBlaCarHeader.html');
?>

<body>
  <?php
  include $rootPath . '/app/view/fragment/fragmentBlaBlaCarMenu.php';
  ?>
  <div class="container">
    <h2>Liste des utilisateurs de l'application</h2>

    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col">id</th>
          <th scope="col">nom</th>
          <th scope="col">prénom</th>
          <th scope="col">rôle</th>
          <th scope="col">login</th>
          <th scope="col">password</th>
          <th scope="col">solde</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($results as $element) {
          printf(
            "<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%d</td></tr>",
            $element->getId(),
            $element->getNom(),
            $element->getPrenom(),
            $element->getRole(),
            $element->getLogin(),
            $element->getPassword(),
            $element->getSolde()
          );
        }
        ?>
      </tbody>
    </table>
  </div>
  <?php include $rootPath . '/app/view/fragment/fragmentBlaBlaCarFooter.html'; ?>