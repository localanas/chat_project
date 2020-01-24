<?php

namespace App\Controller;

use Framework\Controller\Controller;
use Framework\Session\Session;
use App\Model\User;

/**
 * Contrôleur gérant la connexion au site
 * Class AuthenticationController
 */
class AuthenticationController extends Controller
{
    /*** @var User */
    private $user;

    /**
     * AuthenticationController constructor.
     */
    public function __construct()
    {
        $session = new Session();
        if($session && $session->isSessionHas('user')){
            $this->redirectTo('home');
        }
        $this->user = new User();
    }

    /**
     * @return mixed|void
     * @throws /Exception
     */
    public function index()
    {
        //on pass data et action ou action index par defaut pour générer la vue correspond comme renderView de symfony
        $this->render();
    }

    /**
     * Login se connecter
     * @throws /Exception
     */
    public function login()
    {
        if ($this->request->isHasParameterAndHasAValue("username") &&
            $this->request->isHasParameterAndHasAValue("password"))
        {
            $username = $this->request->getParameter("username");
            $password = $this->request->getParameter("password");
            $user = $this->user->login($username);

            if ($user)
            {
                $hashed_password = $user['password'];
                if (password_verify($password, $hashed_password))
                {
                    $user['password'] = null;
                    //changer son status pour devenir un memebre connecter 
                    $this->user->updateStatus(true, $user['id']);
                    $user['status'] = true;
                    //setter la session avec data de user puis redirecter a la page home
                    $this->request->getSession()->setAttribute("user", $user);
                    $this->redirectTo("home");
                }
                $this->render(['msgErreur' => 'Login ou mot de passe incorrects'], "index");
            }
            else
                $this->render(['msgErreur' => 'Login ou mot de passe incorrects'], "index");
        }
        else
            throw new \Exception("Action impossible : login ou mot de passe non défini");
    }

    /**
     * se déconnecter 
     * @throws /Exception
     */
    public function logout()
    {
        $user = $this->request->getSession()->getAttribute("user");
        $this->user->updateStatus(false, $user[id]);
        //suprimer la session pour déconnecter le user 
        $this->request->getSession()->destroy();
        $this->redirectTo("authentication");
    }
}