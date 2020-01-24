<?php
namespace  Framework\Request;

use Framework\Session\Session;

/**
 * Class gérer les demandes pour passer sa a le router qui va savoir le controlleur et l'action 
 * principe connais dans plusieurs framework php 
 * Class Request
 */
class Request implements RequestInterface
{
    /**
     * paramètres de la requête
     * @var string
     */
    private $parameters;

    /*** @var Session */
    private $session;

    /**
     * Request constructor.
     * @param $parameters
     */
    public function __construct($parameters)
    {
        $this->parameters = $parameters;
        $this->session = new Session();
    }

    /**
     * Renvoie vrai si le paramètre existe dans la requête
     * @param $name
     * @return bool|mixed
     */
    public function isHasParameterAndHasAValue($name)
    {
        return (isset($this->parameters[$name]) && $this->parameters[$name] != "");
    }

    /**
     * Renvoie la valeur du paramètre demandé
     * Lève une exception si le paramètre est introuvable
     * @param $name
     * @return mixed|string
     * @throws /Exception
     */
    public function getParameter($name)
    {
        if ($this->isHasParameterAndHasAValue($name))
            return $this->sanitize($this->parameters[$name]);
        else
            throw new \Exception("Paramètre '$name' absent de la requête");
    }

    /**
     * Renvoie l'objet session associé à la requête
     * @return mixed|Session
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * Nettoie une valeur insérée dans une page HTML
     * @param $value
     * @return string
     */
    private function sanitize($value)
    {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8', false);
    }
}