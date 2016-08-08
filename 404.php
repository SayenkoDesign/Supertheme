<?php
require_once __DIR__.'/app/bootstrap.php';

$twig = $container->get("twig.environment");
echo $twig->render('404.html.twig');
