<?php

namespace Application\Providers;

class View {
    /**
     * @var \Twig_Environment
     */
    protected $twig;

    /**
     * View constructor.
     */
    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(base_path('resources/views'));
        $twig = new \Twig_Environment($loader);

        $twigFunctions = new \Twig_SimpleFunction(\TwigFunctions::class, function ($method, $params=[]){
            return \TwigFunctions::method($params);
        });

        $twig->addFunction($twigFunctions);

        $this->twig = $twig;

    }

    /**
     * @param string $view
     * @param array $data
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function render(string $view, array $data = []):string {
        return $this->twig->render($view, $data);
    }
}