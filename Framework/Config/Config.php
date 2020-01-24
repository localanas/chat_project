<?php
namespace  Framework\Config;

/**
 * Class Config pour facilter d'utiliser les paramétre de l'environnement et la Connextion avec la BD
 */
class Config implements  ConfigInterface
{

    /*** @var string */
    private static $parameters;

    /**
     * Renvoie la valeur d'un paramètre de configuration
     * @param $name
     * @param null $defaultValue
     * @return mixed|null
     * @throws /Exception
     */
    public static function get($name, $defaultValue = null)
    {
        return isset(self::getParameters()[$name])?self::getParameters()[$name]: $defaultValue;
    }

    /**
     * Design Pattern Singleton LazyLoding
     * Renvoie le tableau des paramètres en le chargemant au besoin de fichier configuration
     * @return array|false|string
     * @throws /Exception
     */
    private static function getParameters()
    {
        //principe de singleton si la variable et null onva setter les valeurs de fichierdans cette variable
        if (self::$parameters == null)
        {
            $filePath = ".env";
            if (!file_exists($filePath))
                throw new \Exception("Aucun fichier de configuration trouvé");
            else
                // parse_ini_file recuper les données d'un fichier sous format array
                self::$parameters = parse_ini_file($filePath);
        }
        // si variable n'est pas empty on va recuperer les données de configuration depuis elle car variable static garde la valeur comme les consts
        return self::$parameters;
    }
}