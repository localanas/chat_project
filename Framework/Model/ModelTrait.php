<?php
namespace  Framework\Model;

/**
 * Trait ModelTrait
 * pour ne pas surcharger le Model a devient un peut lisible
 */
trait ModelTrait
{
    // si on trouve aprés  des fonctionalité se repeter dans plusieurs Model
    
    /**
     * Exécute une requête SQL éventuellement paramétrée
     */
    public function executeQuery($sql, $params = null) {
        // si la requette no contient pas de paramétre on peur pas de la security
        if ($params == null)
            $result = self::getDbConnexion()->query($sql);
        else {
            //sinon il faudra préparer la requette pour éviter l'injection sql
            $result = self::getDbConnexion()->prepare($sql);
            $result->execute($params);
        }
        
        return $result;
    }
}