<?php
    namespace AulaLoja\Controllers;
    
    abstract class Controller {
        protected $container;
        
        public function __construct(\Slim\Container $container) {
            $this->container = $container;
        }
        
        public function __get($atributo) {
            if ($this->container->{$atributo}){
                return $this->container->{$atributo};
            }            
        }
    }
    