<?php

namespace  Framework\Session;

/**
 * La raison de cette class c'est une contrat pour que la class Session implement obligatoirement ces method
 * Interface SessionInterface
 */
interface SessionInterface
{
    /*** @return mixed */
    public function destroy();

    /**
     * @param $name
     * @param $value
     * @return mixed
     */
    public function setAttribute($name, $value);

    /**
     * @param $name
     * @return mixed
     */
    public function isSessionHas($name);

    /**
     * @param $name
     * @return mixed
     */
    public function getAttribute($name);

}