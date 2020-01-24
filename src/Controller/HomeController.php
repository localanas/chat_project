<?php

namespace App\Controller;

use App\Model\User;
use Framework\View\View;

/**
 * Class HomeController
 */
class HomeController extends SecurityController
{
    /*** @var User */
    private $user;

    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * Affiche les détails sur un billet
     * @return mixed|void
     * @throws /Exception
     */
    public function index()
    {
        $user = $this->request->getSession()->getAttribute("user");
        $this->render(['user' => $user]);
    }


    public function showListMembers()
    {
        try{
            // check est ce que cette requette et une requette ajax
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH'])
                && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                $user = $this->request->getSession()->getAttribute("user");
                $users = $this->user->getAll($user['id']);
                // voir tous les membres quand peut discuter avec eux
                $view = new View('showListMembers', $this->retrieveTemplateNameFromController());
                echo $view->generateViewContent($view->getFileName(),['users' => $users]);
            }
        }
        catch (\Exception $e) {
            // si demande n'est pas ajax ou un autre error
            return $e->message();
        }
    }
}