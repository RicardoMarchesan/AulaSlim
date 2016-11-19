<?php

namespace AulaLoja\Controllers;
use AulaLoja\Controllers\Controller;

class HomeController extends Controller {

    public function index($request, $response, $args) {
        return $this->view->render($response, 'home.twig', []);
    }

}

?>
