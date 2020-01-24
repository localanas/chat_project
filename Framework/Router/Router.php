<?php

namespace  Framework\Router;

use Framework\Request\Request;
use Framework\View\View;
use Framework\Controller\Controller;

/** 
 * cette class instance un object Request pour le role de définir le controlleur et l'action exécuter 
 * Class Router
 */
class Router implements RouterInterface
{
    /**
     * Route une requête entrante : exécute l'action associée
     */
    public function routeRequest()
    {
        try {
            //il se base sur la Class Request pour savoir aprés le controlleur et l'action a executer
            // Fusion des paramètres GET et POST de la requête
            $request = new Request(array_merge($_GET, $_POST));
            /*** @var Controller $controller */
            $controller = $this->createController($request);
            $action = $this->defineAction($request);
            $controller->executeAction($action);
        }
        catch (\Exception $e) {
            $this->handleError($e);
        }
    }

    /**
     * Crée le contrôleur approprié en fonction de la requête reçue
     * @param Request $request
     * @return mixed|string
     * @throws /Exception
     */
    public function createController(Request $request)
    {
        //default controller
        $controller = "home";
        // recuper le noms de controller depuis request
        if ($request->isHasParameterAndHasAValue('controller')) {
            $controller = $request->getParameter('controller');
            $controller = ucfirst(strtolower($controller));
        }

        // définir le namespace de ce controller pour instancée
        $controllerClass =  "App\\Controller\\".$controller."Controller";
        
        if (class_exists($controllerClass)) {
            $controller = new $controllerClass();
            $controller->setRequest($request);
            return $controller;
        }
        else
            throw new \Exception("Class '$controllerClass' introuvable");
    }

    /**
     * Détermine l'action à exécuter en fonction de la requête reçue
     * @param Request $request
     * @return mixed|string
     * @throws /Exception
     */
    private function defineAction(Request $request)
    {
        $action = "index";  // Action par défaut
        //recupérer le nom de l'action
        if ($request->isHasParameterAndHasAValue('action'))
            $action = $request->getParameter('action');

        return $action;
    }

    /**
     * Manipuler les errors avec des message compéhensible son montre les données de serveurs (sécurity)
     * @param \Exception $exception
     */
    private function handleError(\Exception $exception)
    {
        $view = new View('error');
        $view->generatePageContent(array('errorMessage' => $exception->getMessage()));
    }
}