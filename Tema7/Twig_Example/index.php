<?php

    require __DIR__ . '/templates/index.html.twig';

    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;

    $loader = new FilesystemLoader(__DIR__ . '/templates');
    $twig = new Environment($loader);

    echo $twig->render('first.html.twig', ['name' => 'John Doe', 
        'occupation' => 'gardener']);