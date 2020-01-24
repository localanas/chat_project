<?php

namespace App\Controller;

use Framework\Controller\Controller;

/**
 * comme SecurityController de symfony qui gére l'authentification et les role ACL 
 * Classe parente des contrôleurs soumis à authentification
 */
abstract class SecurityController extends Controller
{
    public function executeAction($action)
    {
        // Vérifie si les informations utilisateur sont présents dans la session
        if ($this->request->getSession()->isSessionHas("user"))
            parent::executeAction($action);
        // si non la redirection vers l'authentification    
        else
            $this->redirectTo("authentication");
    }
}