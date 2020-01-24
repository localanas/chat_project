<?php

namespace App\Controller;

use App\Model\Conversation;
use App\Model\Message;
use App\Model\User;
use Framework\View\View;
use http\Exception;

/**
 * s'occupe par le chat dans mon site (requette Http de Ajax)
 * Class ChatController
 */
class ChatController extends SecurityController
{
    /*** @var Conversation */
    private $conversation;

    /*** @var Message */
    private $message;

    /*** @var User */
    private $user;

    /*** ChatController constructor.*/
    public function __construct()
    {
        $this->conversation = new Conversation();
        $this->message = new Message();
        $this->user = new User();
    }

    /**
     * index c'est son role recuper les deux users et s'encharger a leurs conversation
     * @return mixed|void
     * @throws /Exception
     */
    public function index()
    {
        // recuper le user avec lequel on va discuter 
        $idOtherUser = $this->request->getParameter('id');
        $otherUser   = $this->user->get($idOtherUser);
        //user et la variable $otherUser son les utilisateurs de cette discusion qui fais 
        //un chat entre elle 
        // user connecter 
        $user = $this->request->getSession()->getAttribute("user");
        $idUser = $user['id'];
        // recuperer les conversation entre si deux user si empty on crée un conversation 
        $conversation = $this->conversation->get($user['id'], $idOtherUser);
        if ($conversation)
            // si la conversation et déja exist
            $idConversation = $conversation['id'];
        else
        {
            // sinon on crée une nouvelle discution dans la table discution avec les deux clé primére 
            //de deux user on défini sa comme des clé étrangére dans la table conversation
            $this->conversation->add($idUser, $idOtherUser);
            $conversation = $this->conversation->get($idUser, $idOtherUser);
            $idConversation = $conversation['id'];
        }
        // on a passer les données a la vue sans action car l'action par defaut et index
        $this->render(['user' => $user,'idConversation' => $idConversation,'otherUser'  => $otherUser]);
    }

    /**
     * @throws /Exception
     */
    public function addMessage()
    {
        try{
            // check est ce que cette requette et une requette ajax pour faire un peu de sécurité sur cette action car c'est obligatoir ajax car il y'a un ficher javascript communique avec le json envoyé
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])
                && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                $idConversation = $this->request->getParameter('id');
                $idUser = $this->request->getSession()->getAttribute("user")['id']; // connected user
                $content = $this->request->getParameter('content');
                $this->message->add($idUser, $content, $idConversation);
                //ajouter message avec methode post http ajax 
                echo json_encode(['code' => 200, 'idConversation' => $idConversation]);
            }
        }
        catch (\Exception $e) {
            // si demande n'est pas ajax ou un autre error
            return $e->message();
        }

    }

    /**
     * @throws /Exception
     */
    public function chatMessenger()
    {
        try{
            // check est ce que cette requette et une requette ajax pour faire un peu de sécurité sur cette action car c'est obligatoir ajax car il y'a un ficher javascript communique avec le json envoyé
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])
                && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                $idConversation = $this->request->getParameter('id');
                //recuper tous les messages de la conversation
                $messages  = $this->message->getAllByConversation($idConversation);
                $user = $this->request->getSession()->getAttribute("user");
                $view = new View('chatMessenger', $this->retrieveTemplateNameFromController());
                echo $view->generateViewContent($view->getFileName(),['messages' => $messages, 'user' => $user]);
            }
        }
        catch (\Exception $e) {
            // si demande n'est pas ajax ou un autre error
            return $e->message();
        }
    }
}