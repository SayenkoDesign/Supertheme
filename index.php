<?php
require_once __DIR__ . '/bootstrap.php';

$twig = $container->get("twig.environment");
echo $twig->render('base.html.twig');