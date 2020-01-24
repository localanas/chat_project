<?php

namespace  Framework\Controller;

use Framework\Config\Config;
use Framework\Request\Request;
use Framework\View\View;

/**
 * Class Controller
 */
abstract class Controller
{
    use ControllerTrait;

    /*** @var string */
    private $action;

    /*** @var Request */
    protected $request;

    /**
     * on pass data et action pour générer la vue correspond comme renderView de symfony
     * @param array $viewData
     * @param null $action
     * @throws /Exception
     */
    protected function render($viewData = array(), $action = null)
    {
        $viewAction = $this->action;
        if ($action != null)
            $viewAction = $action;
            
        $controller = $this->retrieveTemplateNameFromController();
        $view = new View($viewAction, $controller);
        $view->generatePageContent($viewData);
    }

    /**
     * Méthode abstraite correspondant à l'action par défaut
     * Oblige les classes dérivées à implémenter cette action par
     * je peux le défini aussi comme une methode dans une interface
     * @return mixed
     */
    public abstract function index();
    /**
     * Effectue une redirection vers un contrôleur et une action spécifiques
     * @param $controller
     * @param null $action
     * @throws /Exception
     */
    protected function redirectTo($controller, $action = null)
    {
        $webRoot = Config::get("webRoot", "/");
        header("Location:" . $webRoot . $controller . "/" . $action);
    }

    /**
     * Détermination du nom du fichier vue à partir du nom du contrôleur actuel
     * @return string|string[]
     */
    protected function retrieveTemplateNameFromController()
    {
        $controllerClass = get_class($this);
        return str_replace("Controller", "", $controllerClass);
    }

    /**
     * Définit la requête entrante
     * @param Request $request
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

}