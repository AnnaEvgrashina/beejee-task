<?php

namespace App\Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View
{
    private Environment $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__. '/../Views/');
        $this->twig = new Environment($loader);
    }

    public function render(string $template, array $data = []): string
    {
        return $this->twig->render($template . '.html.twig', $data);
    }
}