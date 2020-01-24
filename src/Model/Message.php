<?php

namespace App\Model;

use Framework\Model\Model;

/**
 * Cette class recuper tous les message d'une conversation 
 * et ajouter des messages a la conversation
 * Message class
 */
class Message extends Model
{
    /**
     * get all  messages pour une conversation entre deux user
     * @param $idConversation
     * @return bool|false|\PDOStatement
     */
    public function getAllByConversation($idConversation)
    {
        $sql = "SELECT message.id, message.id_user, message.content, message.created_at, users.username, users.status
                FROM message JOIN users ON message.id_user = users.id
                WHERE id_conversation=? ORDER BY message.created_at ASC";

        return $this->executeQuery($sql, array($idConversation));
    }

    /**
     * Ajouter un message a une discution entre deux utilisateur
     * @param $idUser
     * @param $content
     * @param $idConversation
     */
    public function add($idUser, $content, $idConversation)
    {
        $sql = 'INSERT INTO message(created_at, content, id_user, id_conversation)VALUES(?, ?, ?, ?)';
        $date = \date('Y-m-d H:i:s');  // Récupère la date courante
        $this->executeQuery($sql, array($date, $content, $idUser, $idConversation));
    }
}