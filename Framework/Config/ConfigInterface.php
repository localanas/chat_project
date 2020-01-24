<?php
namespace  Framework\Config;

/**
 * La raison de cette class c'est une contrat pour que la class config implement obligatoirement ces methods
 * Interface ConfigInterface
 */
interface ConfigInterface
{
    /**
     * @param $name
     * @param null $defaultValue
     * @return mixed
     */
    public static function get($name,$defaultValue=null);
}