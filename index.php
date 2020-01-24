<?php
// Design Pattern Front Controller => une seul entrer de l'application comme le index.php + Kernel de Symfony
// autoload via composer Psr-4
require_once 'vendor/autoload.php';

// object Class router
$router = new Framework\Router\Router();

// récuper la request puis trouvez le controller et l'action comme le role de frontcontroller de symfony avec le kernel noyau de l'application méme idée mais c'est pas la méme complexité de symfony czar il gére plusieur choses
$router->routeRequest();