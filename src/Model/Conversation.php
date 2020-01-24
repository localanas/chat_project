<?php

namespace App\Model;

use Framework\Model\Model;

/**
 * Class donne les conversation et la discution stocker entre deux utilisateur ou
 * crée ajouter et démarer une nouvelle discusion
 * Conversation class
 */
class Conversation extends Model
{
    /**
     * Vérifie si les deux user a déja des discution en recuper sa 
     * 
     * @param $idUser1
     * @param $idUser2
     * @return mixed|null
     */
    public function get($idUser1, $idUser2)
    {
        $sql = "SELECT * FROM conversation
                WHERE (id_user1=? AND id_user2=?) OR (id_user1=? AND id_user2=?)";
        $conversation = $this->executeQuery($sql, array($idUser1, $idUser2, $idUser2, $idUser1));
        if ($conversation->rowCount() == 1)
            return $conversation->fetch(\PDO::FETCH_ASSOC);
        else
            return null;
    }

    /**
     * @param $idUser1
     * @param $idUser2
     */
    public function add($idUser1, $idUser2)
    {
        $sql = 'INSERT INTO conversation(created_at, id_user1, id_user2) VALUES(?, ?, ?)';
        $date = date('Y-m-d H:i:s');  // Récupère la date courante
        $this->executeQuery($sql, [$date, $idUser1, $idUser2]);
    }
}