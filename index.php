<?php

// Para permitir uso do Slim
require 'vendor/autoload.php';

// $config -> variável para configurar Slim
$config = [
    'settings' => [
        'displayErrorDetails' => true
    ]
];

// Intancia um objeto Slim
$app = new \Slim\App($config);

// Container da aplicação
$container = $app->getContainer();

$container['dao'] = function($container) {
    return new PDO('mysql:host=localhost;dbname=slim', 'root', '');
};

$container['HomeController'] = function($container) use ($app) {
    return new AulaLoja\Controllers\HomeController($container);
};

    $container['PessoasController'] = function($container) use ($app) {
        return new AulaLoja\Controllers\PessoasController($container);
    };

    $container['view'] = function($container) {
        $folder = __DIR__;
        $view = new \Slim\Views\Twig($folder . '/app/public/views', ['cache' => false]);

        $view->addExtension(new \Slim\Views\TwigExtension(
                $container->router, $container->request->getUri()
        ));

        return $view;
    };

    $app->get('/', 'PessoasController:listaAtendimentos')->setname('home');

    $app->get('/pessoas', 'PessoasController:listaPessoas')->setname('pessoas');
    $app->get('/cadastro', 'PessoasController:listaPessoas')->setname('cadastro');
    $app->get('/contatos', 'PessoasController:listaPessoas')->setname('contatos');
    $app->get('/pacientes', 'PessoasController:listaPessoas')->setname('pacientes');
    $app->get('/tipoAtendimento', 'PessoasController:listaPessoas')->setname('tipoAtendimento');
    $app->get('/atendimento', 'PessoasController:listaPessoas')->setname('atendimento');


    $app->post('/', 'PessoasController:addpessoa');


// Inicializa a instância do Slim
    $app->run();
?>
