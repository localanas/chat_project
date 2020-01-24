<?php
namespace  Framework\Model;
use Framework\Config\Config;


/**
 * class grouper les function réutilisable dans les models comme le principes de Repository dans symfony 
 * Class Model
 */
abstract class Model
{

    use ModelTrait;

    /*** Objet PDO d'accès à la BD*/
    private static $dbConnexion;

    /**
     * Renvoie un objet de connexion à la BD en initialisant la connexion au besoin
     * c'est un principe s'appelle LazyLoding chargement pareseu j'ai utilise le design Pattern Singleton
     * pour instancie l'objet PDO une seul fois et gagne coté performance
     */
    private static function getDbConnexion()
    {
        if (self::$dbConnexion == null) {
            $dsn = Config::get("dsn");
            $user = Config::get("user");
            $password = Config::get("password");
            self::$dbConnexion = new \PDO($dsn, $user, $password,
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
                ]);
        }
        return self::$dbConnexion;
    }
}