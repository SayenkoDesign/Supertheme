<?php
require_once __DIR__.'/App/bootstrap.php';

$twig = $container->get("twig.environment");
echo $twig->render('basic.html.twig');
