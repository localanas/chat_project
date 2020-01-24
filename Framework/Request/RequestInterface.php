<?php
namespace  Framework\Request;

/**
 * La raison de cette class c'est une contrat pour que la class Request implement obligatoirement ces method
 * Interface RequestInterface
 */
interface RequestInterface
{
    /**
     * @param $name
     * @return mixed
     */
    public function isHasParameterAndHasAValue($name);

    /**
     * @param $name
     * @return mixed
     */
    public function getParameter($name);

    /*** @return mixed */
    public function getSession();
}