<?php
namespace  Framework\Controller;

/**
 * Trait ControllerTrait
 * pour ne pas surcharger le Controller a devient un peut lisible
 */
trait ControllerTrait
{
     //si on trouve aprés  des fonctionalité se repeter dans plusieurs controller on va regrouper dans se trait
    
    /**
     * Exécute l'action à réaliser
     * @param $action
     * @throws /Exception
     */
    public function executeAction($action)
    {
        // $this si l'objet qui appelle la fonction et action on le passer si on pass pas prends l'action index 
        if (method_exists($this, $action)) {
            $this->action = $action;
            $this->{$this->action}();
        }
        else {
            $controllerClass = get_class($this);
            throw new \Exception("Action '$action' non définie dans la classe $controllerClass");
        }
    }
}