<?php
namespace  Framework\Router;

/**
 * La raison de cette class c'est une contrat pour que la class Router implement obligatoirement ces method
 * Interface RouterInterface
 */
interface RouterInterface
{
    /**
     * @return mixed
     */
    public function routeRequest();
}