<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <link rel="icon" href="assets/img/favicon.ico" type="image/ico">
        <base href="<?= $webRoot ?>" >
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/style.css" />
        <link rel="stylesheet" href="assets/css/font-awesome.min.css" />
        <title><?= $title ?></title>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div id="global">
            <div class="container">
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <header class="text-center">
                            <a href="index.php" ><h2 id="titleWebSite">Chat Platform </h2></a>
                            <p>un T’chat, construit sur un modèle MVC, sans framework.</p>
                            <h4> Test Pratique de <a href="http://www.hiitconsulting.com/" title="voir plus sur cette société" id="titleWebSite">Hiit Consulting</a> </h4>
                            <img src="assets/img/vous.png"  alt="logo hiit consulting" class="img-circle img-fluid"/>
                        </header>
                    </div>
                </div>
                <div id="contenu">
                    <?= $content ?>
                </div> <!-- #contenu -->
                <footer class="text-center" id="piedBlog">
                    <div class="jumbotron jumbotron-fluid">
                                <h3>Chat réalisé avec PHP5, HTML5, CSS3, Bootstrap3 et Jquery(Ajax partie requete Http)</h3>
                    </div>
                </footer>
            </div>
        </div>
    </body>
</html>