<form role="form" action="authentication/login" method="POST">
    <fieldset>
        <?php if (isset($msgErreur)): ?>
            <div class="alert alert-danger">
                <h2><?= $msgErreur ?></h2>
            </div>
        <?php endif; ?>
        <div class="form-group">
            <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
        </div>
        <div class="form-group">
            <input class="form-control" placeholder="Password" name="password" type="password" value="">
        </div>
        <button type="submit" class="btn btn-lg btn-success btn-block">Connexion</button>
    </fieldset>
</form>