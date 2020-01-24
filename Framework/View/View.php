<?php
namespace  Framework\View;

use Framework\Config\Config;

class View implements  ViewInterface
{
    /**
     * Nom du fichier associé à la vue
     * @var string
     */
    private $fileName;

    /**
     * Titre de la vue (défini dans le fichier vue)
     * @var string
     */
    private $title;

    /**
     * View constructor.
     * @param $action
     * @param string $controller
     */
    public function __construct($action, $controller = "") {
        $fileName = "templates/";
        if ($controller != "")
            $fileName = $fileName . $controller . "/";
        $this->fileName = $fileName . $action . ".php";
    }

    /*** @return string */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Génère et affiche la vue
     * @param $data
     * @throws /Exception
     */
    public function generatePageContent($data)
    {
        // Génération de la partie spécifique de la vue
        // quand veut afficher comme un contenu dans mon page layout master page base.php
        $content = $this->generateViewContent($this->fileName, $data);
        // recuperer la racine du site
        $webRoot = Config::get("webRoot", "/");
        // Génération du gabarit commun utilisant la partie spécifique
        $vue = $this->generateViewContent('templates/base.php',
            array('title' => $this->title, 'content' => $content,
                'webRoot' => $webRoot));
        // Renvoi de la vue générée au navigateur
        // qui a sa gabarit base.php + son contenu comme extends base.twig.html + block content end block in symfony
        echo $vue;
    }

    // Génère un fichier vue et renvoie le résultat produit
    public function generateViewContent($fileName, $data)
    {
        // j'ai travailler avec les namespeace alors comme solution j'ai transfére ce namespeace comme 
        // un file de templates pour les requeres les vues 
        $fileName = str_replace('App\\','',$fileName);
        $fileName = str_replace('\\','',$fileName);
        if (file_exists($fileName)) {
            // Rend les éléments du tableau $donnees accessibles dans la vue
            extract($data);
            // Démarrage de la temporisation de sortie pour ne pas afficher les data dans cette action 
            // on veut afficher data dans les vue qu'on va render 
            ob_start();
            // Inclut le fichier vue
            // Son résultat est placé dans le tampon de sortie
            require $fileName;
            // Arrêt de la temporisation et renvoi du tampon de sortie
            return ob_get_clean();
        }
        else
            throw new \Exception("Fichier '$fileName' introuvable");
    }
}