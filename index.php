<?php

// start session
session_start();

// reset session
$_SESSION = [];
session_destroy();
$_SESSION['login_id'] = -1;

header('Location: app/router/router.php?action=truc');
?>