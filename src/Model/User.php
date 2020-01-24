<?php
namespace App\Model;

use Framework\Model\Model;

/**
 * Cette class manipuler et gérer les utilisateur recuprer et tester si user connecter
 * inscrivé un user ou recuper un seul user 
 * User class
 */
class User extends Model
{
    /**
     * Vérifie qu'un utilisateur existe dans la BD
     * pour soit authentifier s'il exist a saisi sans login et mtp
     * @param $username
     * @return |null
     */
    public function login($username)
    {
        $sql = "SELECT * FROM users WHERE username=?";
        $user = $this->executeQuery($sql, array($username));
        if ($user->rowCount() == 1)
            return $user->fetch(\PDO::FETCH_ASSOC);
        else
            return null;
    }

    /**
     * recupérer tout les users
     * @param $id
     * @return mixed
     */
    public function getAll($id)
    {
        $sql = "SELECT id, username, status FROM users  WHERE id!=?";
        return $this->executeQuery($sql, array($id));
    }

    /**
     * cette fonction pour un role de update le status d'un user lors de l'authentification 1 ou logout 0
     * @param $status
     * @param $id
     * @return mixed
     */
    public function updateStatus($status, $id)
    {
        $sql = "UPDATE users SET status=? WHERE id=?";
        return $this->executeQuery($sql, array($status, $id));
    }

    /**
     * Ajouter un utilisateur j'ai ajouter via un script 
     * j'ai pas le temps de faire une action dans controller register
     * @param $username
     * @param $password
     */
    public function register($username, $password)
    {
        $sql = 'INSERT INTO users(username, password) VALUES(?, ?)';
        $this->executeQuery($sql, array($username, password_hash($password, PASSWORD_DEFAULT)));
    }

    /**
     * Renvoie un utilisateur existant dans la BD
     * avec biensur son status est ce que connecter or non
     * @param $id
     * @return mixed
     * @throws /Exception
     */
    public function get($id)
    {
        $sql = "SELECT username, status FROM users WHERE id=?";
        $user = $this->executeQuery($sql, array($id));
        if ($user->rowCount() == 1)
            return $user->fetch(\PDO::FETCH_ASSOC);  // Accès à la première ligne de résultat
        else
            throw new \Exception("Aucun utilisateur ne correspond au identifiant fourni");
    }
}