<?php

require 'autoload.php';

$twig = new Twig_Environment($loader, array(
    'debug' => true
));

$twig->addExtension(new Twig_Extension_Debug());

echo $twig->render('index.twig');

